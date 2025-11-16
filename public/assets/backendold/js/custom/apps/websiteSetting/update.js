"use strict";

var KTWebsiteSettingUpdate = (function () {
    const form = document.getElementById("kt_modal_websiteSetting_update_form");
    const submitButton = form.querySelector('[data-kt-websiteSetting-update-action="submit"]');
    const imageInputElement = document.querySelector(".image-input");
    let imageInputInstance = null;

    const initWebsiteSetting = function () {

        if (imageInputElement && typeof KTImageInput !== 'undefined' && imageInputInstance === null) {
            imageInputInstance = new KTImageInput(imageInputElement);
        } else if (!imageInputElement) {
            console.error("Element with class 'image-input' not found.");
            return;
        } else if (typeof KTImageInput === 'undefined') {
            console.error("KTImageInput library is not defined.");
            return;
        }

        $.get('websiteSetting/getData', function (response) {
            if (response.success && response.data) {
                $('#website_name').val(response.data.website_name);
                $('#website_description').val(response.data.website_description);
                $('#website_address').val(response.data.website_address);
                $('#website_phone').val(response.data.website_phone);
                $('#website_email').val(response.data.website_email);
                $('#website_youtube').val(response.data.website_youtube);
                $('#website_facebook').val(response.data.website_facebook);
                $('#website_x').val(response.data.website_x);
                $('#website_instagram').val(response.data.website_instagram);

                if (response.data.website_logo && imageInputInstance && typeof imageInputInstance.setImage === 'function') {
                    const logoUrl = '/storage/' + response.data.website_logo;
                    imageInputInstance.setImage(logoUrl);
                } else if (imageInputInstance && typeof imageInputInstance.setImage === 'function') {
                    imageInputInstance.setImage('/assets/backend/media/svg/avatars/blank.svg');
                } else {
                    if (imageInputElement && response.data.website_logo) {
                        const previewWrapper = imageInputElement.querySelector('.image-input-wrapper');
                        if (previewWrapper) {
                            previewWrapper.style.backgroundImage = `url('/storage/${response.data.website_logo}')`;
                        }
                    }
                }
            }
        }).fail(function(jqXHR) {
            console.error("AJAX getData failed:", jqXHR);
            Swal.fire({
                text: jqXHR.responseJSON?.message || "Terjadi kesalahan saat mengambil data pengaturan website.",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Oke, mengerti!",
                customClass: {
                    confirmButton: "btn btn-primary",
                },
            });
        });
    };

    const handleFormSubmit = function () {
        if (submitButton) {
            submitButton.addEventListener("click", function (event) {
                event.preventDefault();

                if (typeof FormValidation !== "undefined") {
                    var validation = FormValidation.formValidation(form, {
                        fields: {
                            website_name: {
                                validators: {
                                    notEmpty: {
                                        message: "Nama Website wajib diisi",
                                    },
                                },
                            },
                            website_description: {
                                validators: {
                                    notEmpty: {
                                        message: "Deskripsi Website wajib diisi",
                                    },
                                },
                            },
                            website_logo: {
                                validators: {
                                    file: {
                                        extension: 'png,jpg,jpeg',
                                        type: 'image/jpeg,image/png',
                                        maxFiles: 1,
                                        message: 'Jenis file yang diizinkan adalah png, jpg, atau jpeg.',
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
                        console.log("Form validation status:", status);
                        if (status == "Valid") {
                            sendFormData();
                        } else {
                            Swal.fire({
                                text: "Terjadi Kesalahan Validasi! Silakan Cek Data Anda Kembali.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Oke, mengerti!",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                },
                            });
                        }
                    });
                } else {
                    console.warn("FormValidation library not found. Skipping client-side validation.");
                    sendFormData();
                }

                function sendFormData() {
                    console.log("Sending form data...");
                    submitButton.setAttribute("data-kt-indicator", "on");
                    submitButton.disabled = true;

                    const formData = new FormData(form);
                    $.ajax({
                        url: 'websiteSetting/update',
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            console.log("AJAX submit success:", response);
                            submitButton.removeAttribute("data-kt-indicator");
                            submitButton.disabled = false;
                            Swal.fire({
                                text: response.message || `Pengaturan Website Berhasil Diperbarui!`,
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Oke, mengerti!",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                },
                            }).then(function (result) {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        },
                        error: function (xhr) {
                            console.error("AJAX submit failed:", xhr);
                            submitButton.removeAttribute("data-kt-indicator");
                            submitButton.disabled = false;
                            Swal.fire({
                                text: xhr.responseJSON?.message || 'Terjadi Kesalahan! Silakan Cek Data Anda Kembali.',
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Oke, mengerti!",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                },
                            });
                        }
                    });
                }
            });
        } else {
            console.error("Submit button for website setting update not found on init."); // Log lebih spesifik
        }
    };

    return {
        init: function () {
            console.log("KTWebsiteSettingUpdate.init() called.");
            $(document).ready(function() {
                console.log("Document is ready. Calling initWebsiteSetting and handleFormSubmit.");
                initWebsiteSetting();
                handleFormSubmit();
            });
        }
    };
})();

KTWebsiteSettingUpdate.init();
