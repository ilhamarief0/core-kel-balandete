"use strict";

var KTUsersAddUser = (function () {
    const modalElement = document.getElementById("kt_modal_add_banner");
    const form = modalElement.querySelector("#kt_modal_add_banner_form");
    const modal = new bootstrap.Modal(modalElement);
    const submitButton = modalElement.querySelector('[data-kt-users-modal-action="submit"]');

    const showSuccessNotification = function (message, clientName = '') {
        let fullMessage = clientName ? `${clientName} ${message}` : message;
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
                $(".kt_table_banner").DataTable().ajax.reload();
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

            let clientName = $("#kt_modal_add_banner_form input[name='name']").val();

            const handleFormSubmit = function () {
                submitButton.setAttribute("data-kt-indicator", "on");
                submitButton.disabled = true;

                const formData = new FormData(form);

                $.ajax({
                    type: "POST",
                    url: "banner",
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
                            showSuccessNotification(response.message, clientName);
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

            // Ini bagian validasi FormValidation.js (dari Metronic/Keenthemes)
            if (typeof FormValidation !== "undefined") {
                var validation = FormValidation.formValidation(form, {
                    fields: {
                        title: {
                            validators: {
                                notEmpty: {
                                    message: "Title is required",
                                },
                            },
                        },
                        image: { // Validasi untuk field 'image' (jika ada)
                            validators: {
                                notEmpty: {
                                    message: "Image is required",
                                },
                                file: {
                                    extension: 'jpeg,jpg,png,gif',
                                    type: 'image/jpeg,image/png,image/gif',
                                    maxSize: 9048000, // 2MB
                                    message: 'The selected file is not valid',
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
                        // FormValidation akan menampilkan pesan errornya sendiri di bawah field
                        // Kita bisa tambahkan toastr umum jika mau, atau biarkan SweetAlert bawaan jika tidak ada validasi khusus yang ditangkap di sini
                        showErrorNotification(["Please check your input fields."], false);
                    }
                });
            } else {
                // Jika FormValidation tidak terdefinisi, langsung submit form
                handleFormSubmit();
            }
        });
    } else {
        console.error("Submit button not found");
    }
})();
