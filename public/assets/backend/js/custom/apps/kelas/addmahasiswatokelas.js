"use strict";

var KTUsersAddUser = (function () {
    const modalElement = document.getElementById("kt_modal_add_mahasiswa");
    const form = modalElement.querySelector("#kt_modal_add_mahasiswa_form");
    const modal = new bootstrap.Modal(modalElement);
    const submitButton = modalElement.querySelector(
        '[data-kt-addmahasiswa-modal-action="submit"]'
    );
    const inputElm = document.querySelector('#kt_tagify_users');
    const kelasIdInput = document.getElementById('kelas_id');

    function tagTemplate(tagData) {
        return `
            <tag title="${(tagData.title || tagData.email)}"
                    contenteditable='false'
                    spellcheck='false'
                    tabIndex="-1"
                    class="${this.settings.classNames.tag} ${tagData.class ? tagData.class : ""}"
                    ${this.getAttributes(tagData)}>
                <x title='' class='tagify__tag__removeBtn' role='button' aria-label='remove tag'></x>
                <div class="d-flex align-items-center">
                    <div class='tagify__tag__avatar-wrap ps-0'>
                        <img onerror="this.style.visibility='hidden'" class="rounded-circle w-25px me-2" src="{{ asset('assets/frontend/media/${tagData.avatar}') }}">
                    </div>
                    <span class='tagify__tag-text'>${tagData.name}</span>
                </div>
            </tag>
        `
    }

    function suggestionItemTemplate(tagData) {
        return `
            <div ${this.getAttributes(tagData)}
                class='tagify__dropdown__item d-flex align-items-center ${tagData.class ? tagData.class : ""}'
                tabindex="0"
                role="option">

                ${tagData.avatar ? `
                        <div class='tagify__dropdown__item__avatar-wrap me-2'>
                            <img onerror="this.style.visibility='hidden'" class="rounded-circle w-50px me-2" src="{{ asset('assets/frontend/media/${tagData.avatar}') }}">
                        </div>` : ''
                }

                <div class="d-flex flex-column">
                    <strong>${tagData.name}</strong>
                    <span class="text-muted">${tagData.nim}</span> <!-- Displaying NIM here -->
                </div>
            </div>
        `
    }

    // Initialize Tagify when the DOM is ready
    let tagify;

    const initializeTagify = function (data) {
        // Initialize Tagify with data
        tagify = new Tagify(inputElm, {
            tagTextProp: 'name',
            enforceWhitelist: true,
            skipInvalid: true,
            dropdown: {
                closeOnSelect: false,
                enabled: 0,
                classname: 'users-list',
                searchKeys: ['name', 'nim']
            },
            templates: {
                tag: tagTemplate,
                dropdownItem: suggestionItemTemplate
            },
            whitelist: data
        });

        tagify.on('dropdown:show dropdown:updated', onDropdownShow);
        tagify.on('dropdown:select', onSelectSuggestion);
    };

    // Fetch and initialize Tagify data from the route
    fetch('mahasiswa/getDataMahasiswa')
        .then(response => response.json())
        .then(data => {
            // Map the data to match Tagify's required format
            const usersList = data.map(item => ({
                value: item.id,
                name: item.name,
                nim: item.nim
            }));
            initializeTagify(usersList);
        })
        .catch(error => console.error('Error fetching user list:', error));

    // Dropdown event handling
    var addAllSuggestionsElm;
    function onDropdownShow(e) {
        var dropdownContentElm = e.detail.tagify.DOM.dropdown.content;
        if (tagify.suggestedListItems.length > 1) {
            addAllSuggestionsElm = getAddAllSuggestionsElm();
            dropdownContentElm.insertBefore(addAllSuggestionsElm, dropdownContentElm.firstChild);
        }
    }

    function onSelectSuggestion(e) {
        if (e.detail.elm == addAllSuggestionsElm)
            tagify.dropdown.selectAll.call(tagify);
    }

    function getAddAllSuggestionsElm() {
        return tagify.parseTemplate('dropdownItem', [{
            class: "addAll",
            name: "Add all",
            email: tagify.settings.whitelist.reduce(function (remainingSuggestions, item) {
                return tagify.isTagDuplicate(item.value) ? remainingSuggestions : remainingSuggestions + 1;
            }, 0) + " Members"
        }]);
    }

    // Form submit handling
    if (submitButton) {
        submitButton.addEventListener("click", function (event) {
            event.preventDefault();

            // Get client details from the form inputs
            let client_name = $("#nameadd").val();

            // Get selected users from Tagify input and ensure they're integers
            const asistenMatakuliahData = tagify.value.map(item => {
                const id = parseInt(item.value, 10); // Ensure base 10 parsing
                return isNaN(id) ? null : id;  // Return null if the value isn't a valid integer
            }).filter(id => id !== null); // Filter out null values

            // Make sure `asistenMatakuliahData` is not empty
            if (asistenMatakuliahData.length === 0) {
                Swal.fire({
                    text: "Please select valid Asisten Matakuliah!",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok",
                    customClass: {
                        confirmButton: "btn btn-primary",
                    },
                });
                return;
            }

            // Add the Tagify data as an array of integers to the form data
            const formData = new FormData(form);
            asistenMatakuliahData.forEach(id => formData.append('mahasiswa[]', id));
            formData.append('kelas_id', kelasIdInput.value); // Add kelas_id to the formData

            const handleFormSubmit = function () {
                submitButton.setAttribute("data-kt-indicator", "on");
                submitButton.disabled = true;

                // AJAX request to submit the form data
                $.ajax({
                    type: "POST",
                    url: "/kelas/addMahasiswaToKelas/store/" + kelasIdInput.value,
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json', // Ensure you are expecting a JSON response
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function (response) {
                        submitButton.removeAttribute("data-kt-indicator");
                        submitButton.disabled = false;
                        Swal.fire({
                            text: response.message,
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: { confirmButton: "btn btn-primary" }
                        }).then(function (result) {
                            if (result.isConfirmed) {
                                form.reset();
                                modal.hide();
                                location.reload();
                            }
                        });
                    },
                    error: function (xhr) {
                        submitButton.removeAttribute("data-kt-indicator");
                        submitButton.disabled = false;
                        const message = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Terjadi Kesalahan!, Silahkan Cek Data Anda Kembali';
                        Swal.fire({
                            text: message,
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            },
                        });
                    },
                });
            };

            // Validate form if validation library is being used
            if (typeof FormValidation !== "undefined") {
                var validation = FormValidation.formValidation(form, {
                    fields: {
                        name: {
                            validators: {
                                notEmpty: {
                                    message: "Nama Client is required",
                                },
                            },
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: ".fv-row",
                            eleInvalidClass: "",
                            eleValidClass: "",
                        }),
                    },
                });

                validation.validate().then(function (status) {
                    if (status == "Valid") {
                        handleFormSubmit();
                    } else {
                        Swal.fire({
                            text: "Terjadi Kesalahan!, Silahkan Cek Data Anda Kembali",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            },
                        });
                    }
                });
            } else {
                // If no validation library is used, proceed with submission
                handleFormSubmit();
            }
        });
    }

})();

KTUtil.onDOMContentLoaded(function () {
    KTUsersAddUser.init();
});
