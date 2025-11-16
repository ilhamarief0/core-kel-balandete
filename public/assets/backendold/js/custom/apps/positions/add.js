"use strict";

var KTJabatanAdd = (function () {
    const modalElement = document.getElementById("kt_modal_add_jabatan");
    const form = modalElement.querySelector("#kt_modal_add_jabatan_form");
    const modal = new bootstrap.Modal(modalElement);
    const submitButton = modalElement.querySelector('[data-kt-users-modal-action="submit"]');

    var initSelect2 = function() {
        $('select[name="parent_id"], select[name="division_id"]').each(function() {
            var parentModal = $(this).closest('.modal');
            $(this).select2({
                dropdownParent: parentModal.length ? parentModal : $('body'),
                placeholder: $(this).data('placeholder'),
                allowClear: true
            });
        });
    };

    const showSuccessNotification = function (message, jabatanName = '') {
        let fullMessage = jabatanName ? `${jabatanName} ${message}` : message;
        Swal.fire({
            text: fullMessage,
            icon: "success",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
                confirmButton: "btn btn-primary",
            },
        }).then((result) => {
            if (result.isConfirmed) {
                toastr.success(fullMessage, 'Success');
                form.reset();
                modal.hide();
                location.reload(); // Reload halaman untuk melihat perubahan Nestable Tree
            }
        });
    };

    const showErrorNotification = function (messages, isValidationError = false) {
        if (isValidationError) {
            messages.forEach(msg => {
                toastr.error(msg, 'Validation Error');
            });
        } else {
            Swal.fire({
                text: messages[0] || "Terjadi kesalahan!",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn btn-primary",
                },
            });
            toastr.error(messages[0] || "An error occurred.", 'Error');
        }
    };

    if (submitButton) {
        submitButton.addEventListener("click", function (event) {
            event.preventDefault();

            let jabatanName = $("#jabatan_name_add").val();

            const handleFormSubmit = function () {
                submitButton.setAttribute("data-kt-indicator", "on");
                submitButton.disabled = true;

                const formData = new FormData(form);

                $.ajax({
                    type: "POST",
                    url: "jabatan", // URL disesuaikan dengan rute
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function (response) {
                        submitButton.removeAttribute("data-kt-indicator");
                        submitButton.disabled = false;

                        if (response.status === 'success') {
                            showSuccessNotification(response.message, jabatanName);
                        } else {
                            showErrorNotification([response.message || "Something went wrong on success, but not an error."], false);
                        }
                    },
                    error: function (xhr) {
                        submitButton.removeAttribute("data-kt-indicator");
                        submitButton.disabled = false;

                        let errorMessages = [];
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                errorMessages.push(value[0]);
                            });
                            showErrorNotification(errorMessages, true);
                        } else if (xhr.responseJSON && xhr.responseJSON.error) {
                            errorMessages.push(xhr.responseJSON.error);
                            showErrorNotification(errorMessages, false);
                        } else {
                            errorMessages.push("An unexpected error occurred. Please try again.");
                            showErrorNotification(errorMessages, false);
                        }
                    },
                });
            };

            if (typeof FormValidation !== "undefined") {
                var validation = FormValidation.formValidation(form, {
                    fields: {
                        name: {
                            validators: {
                                notEmpty: {
                                    message: "Nama Jabatan wajib diisi",
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
                        showErrorNotification(["Silakan periksa kembali kolom input Anda."], false);
                    }
                });
            } else {
                handleFormSubmit();
            }
        });
    } else {
        console.error("Submit button for add jabatan not found");
    }

    modalElement.addEventListener('shown.bs.modal', function() {
        initSelect2();
    });

    return {
        init: function () {
            // initSelect2(); // Tidak perlu dipanggil di init, sudah di shown.bs.modal
        },
        initSelect2: initSelect2 // Expose initSelect2 for external calls
    };
})();

// On document ready
$(function () {
    KTJabatanAdd.init();
});

