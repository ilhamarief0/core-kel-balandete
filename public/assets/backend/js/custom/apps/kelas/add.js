"use strict";

var KTUsersAddUser = (function () {
    const modalElement = document.getElementById("kt_modal_add_kelas");
    const form = modalElement.querySelector("#kt_modal_add_kelas_form");
    const modal = new bootstrap.Modal(modalElement);

    const submitButton = modalElement.querySelector(
        '[data-kt-addkelas-modal-action="submit"]'
    );

    if (submitButton) {
        submitButton.addEventListener("click", function (event) {
            event.preventDefault();

            // Get client details from the form inputs
            let client_name = $("#nameadd").val();

            const handleFormSubmit = function () {
                submitButton.setAttribute("data-kt-indicator", "on");
                submitButton.disabled = true;

                // AJAX request to submit the form data
                $.ajax({
                    type: "POST",
                    url: "kelas",
                    data: $(form).serialize(),
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (response) {
                        submitButton.removeAttribute("data-kt-indicator");
                        submitButton.disabled = false;
                        Swal.fire({
                            text: `${client_name} Berhasil Di Tambahkan!`,
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            },
                        }).then(function (result) {
                            if (result.isConfirmed) {
                                form.reset();
                                modal.hide();
                                location.reload();
                            }
                        });
                    },
                    error: function (xhr, status, error) {
                        submitButton.removeAttribute("data-kt-indicator");
                        submitButton.disabled = false;
                        Swal.fire({
                            text: "Terjadi Kesalahan!, Silahkan Cek Data Anda Kembali",
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
                        bot_token: {
                            validators: {
                                notEmpty: {
                                    message: "Bot Token is required",
                                },
                            },
                        },
                        chat_id: {
                            validators: {
                                notEmpty: {
                                    message: "Chat ID is required",
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
    } else {
        console.error("Submit button not found");
    }
})();

KTUtil.onDOMContentLoaded(function () {
    KTUsersAddUser.init();
});
