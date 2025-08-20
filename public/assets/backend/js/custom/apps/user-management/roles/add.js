"use strict";

var KTUsersAddRole = (function () {
    const modalElement = document.getElementById("kt_modal_add_roles");
    const form = modalElement.querySelector("#kt_modal_add_roles_form");
    const modal = new bootstrap.Modal(modalElement);

    const submitButton = modalElement.querySelector(
        '[data-kt-roles-modal-action="submit"]'
    );

    if (submitButton) {
        submitButton.addEventListener("click", function (event) {
            event.preventDefault();

            const handleFormSubmit = function () {
                submitButton.setAttribute("data-kt-indicator", "on");
                submitButton.disabled = true;

                // AJAX request to submit the form data
                $.ajax({
                    type: "POST",
                    url: "/usermanagement/roles/store", // Update this URL to your actual route
                    data: $(form).serialize(), // Serialize the form data
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (response) {
                        submitButton.removeAttribute("data-kt-indicator");
                        submitButton.disabled = false;
                        Swal.fire({
                            text: "Role added successfully!",
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
                            text: "An error occurred. Please check your input!",
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
                        role_name: {
                            validators: {
                                notEmpty: {
                                    message: "Role name is required",
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
                            text: "An error occurred. Please check your input!",
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
    KTUsersAddRole.init();
});
