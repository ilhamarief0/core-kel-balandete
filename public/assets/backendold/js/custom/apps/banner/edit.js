"use strict";

var KTBannerEdit = (function () {
    const modalElement = document.getElementById("kt_modal_edit_banner");
    const form = modalElement.querySelector("#kt_modal_edit_banner_form");
    const modal = new bootstrap.Modal(modalElement);
    const submitButton = modalElement.querySelector('[data-kt-users-modal-action="submit"]');

    const showSuccessNotification = function (message, bannerTitle = '') {
        let fullMessage = bannerTitle ? `${bannerTitle} ${message}` : message;
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
                modal.hide();
                $(".kt_table_banner").DataTable().ajax.reload(null, false);
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

    const initEditBanner = function () {
        $(document).on('click', '.edit-banner-btn', function () {
            var bannerId = $(this).data('id');

            $.get('banner/' + bannerId + '/edit', function (response) {
                $('#edit_banner_id').val(bannerId);
                $('#edit_title').val(response.banner.title);

                const currentImage = response.banner.image;
                const defaultImageUrl = 'assets/backend/media/svg/files/blank-image.svg';

                let imagePath = currentImage ? '/storage/' + currentImage : defaultImageUrl;

                const imageInputWrapper = modalElement.querySelector(".image-input-wrapper");

                if (imageInputWrapper) {
                    imageInputWrapper.style.backgroundImage = `url(${imagePath})`;
                    const imageRemoveHiddenInput = form.querySelector('input[name="image_remove"]');
                    if (imageRemoveHiddenInput) {
                        imageRemoveHiddenInput.value = '0';
                    }
                } else {
                    console.error("Image input wrapper not found for preview.");
                }

                if (response.banner.is_active === 'yes') {
                    $('#edit_isactive_yes').prop('checked', true);
                } else if (response.banner.is_active === 'no') {
                    $('#edit_is_active_no').prop('checked', true);
                }
                modal.show();
            }).fail(function(xhr) {
                showErrorNotification(['Failed to load banner data for editing.'], false);
            });
        });
    };

    const handleFormSubmit = function () {
        if (submitButton) {
            submitButton.addEventListener("click", function (event) {
                event.preventDefault();
                let bannerTitle = $("#edit_title").val();
                let bannerId = $('#edit_banner_id').val();

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
                            image: {
                                validators: {
                                    file: {
                                        extension: 'jpeg,jpg,png,gif',
                                        type: 'image/jpeg,image/png,image/gif',
                                        maxSize: 9048000, // 2MB
                                        message: 'The selected file is not a valid image or is too large.',
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
                            sendFormData(bannerId, bannerTitle);
                        } else {
                            showErrorNotification(["Please check the highlighted fields and try again."], false);
                        }
                    });
                } else {
                    sendFormData(bannerId, bannerTitle);
                }
            });
        } else {
            console.error("Submit button for edit banner not found");
        }
    };

    function sendFormData(bannerId, bannerTitle) {
        submitButton.setAttribute("data-kt-indicator", "on");
        submitButton.disabled = true;

        const formData = new FormData(form);
        formData.append('_method', 'PUT');

        // Check if a new image file is selected
        const imageInput = form.querySelector('input[name="image"]');
        if (imageInput && imageInput.files.length === 0) {
            formData.delete('image'); // Remove 'image' from formData if no new file is selected
        }

        $.ajax({
            url: 'banner/' + bannerId,
            method: 'POST', // Use POST for FormData with _method: PUT
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                submitButton.removeAttribute("data-kt-indicator");
                submitButton.disabled = false;

                if (response.status === 'success') {
                    showSuccessNotification(response.message, bannerTitle);
                } else {
                    showErrorNotification([response.message || "An unknown success response occurred."], false);
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
                    errorMessages.push('An unexpected error occurred. Please try again.');
                    showErrorNotification(errorMessages, false);
                }
            },
        });
    }

    return {
        init: function () {
            initEditBanner();
            handleFormSubmit();
        }
    };
})();

KTBannerEdit.init();
