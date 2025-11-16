"use strict";

var KTSignupGeneral = (function () {
    var form, submitButton, validator;

    return {
        init: function () {
            form = document.querySelector("#kt_sign_up_form");
            submitButton = document.querySelector("#kt_sign_up_submit");

            validator = FormValidation.formValidation(form, {
                fields: {
                    email: {
                        validators: {
                            regexp: {
                                regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                                message: "The value is not a valid email address",
                            },
                            notEmpty: {
                                message: "Email address is required",
                            },
                        },
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: "The password is required",
                            },
                            callback: {
                                message: "Please enter a valid password",
                                callback: function (input) {
                                    return passwordMeter.getScore() > 50;
                                },
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

            submitButton.addEventListener("click", function (event) {
                event.preventDefault();

                validator.validate().then(function (status) {
                    if (status === "Valid") {
                        submitButton.setAttribute("data-kt-indicator", "on");
                        submitButton.disabled = true;

                        // AJAX request
                        $.ajax({
                            url: form.getAttribute("action"),
                            type: "POST",
                            data: $(form).serialize(),
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                            },
                            success: function (response) {
                                if (response.success) {
                                    Swal.fire({
                                        text: "You have successfully registered!",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-primary",
                                        },
                                    }).then(function (result) {
                                        if (result.isConfirmed) {
                                            form.reset();
                                            passwordMeter.reset();
                                            window.location.href = response.redirect_url;
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        text: response.message,
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-primary",
                                        },
                                    });
                                }
                            },
                            error: function () {
                                Swal.fire({
                                    text: "Sorry, there was an error. Please try again.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    },
                                });
                            },
                            complete: function () {
                                submitButton.removeAttribute("data-kt-indicator");
                                submitButton.disabled = false;
                            },
                        });
                    } else {
                        Swal.fire({
                            text: "Please fill out the form correctly.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            },
                        });
                    }
                });
            });
        },
    };
})();

KTUtil.onDOMContentLoaded(function () {
    KTSignupGeneral.init();
});
