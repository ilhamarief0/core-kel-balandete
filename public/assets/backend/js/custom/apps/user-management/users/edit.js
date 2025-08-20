"use strict";

var KTUsersEditUser = (function () {
    const modalElement = document.getElementById("kt_modal_edit_users");
    const form = modalElement.querySelector("#kt_modal_edit_users_form");
    const modal = new bootstrap.Modal(modalElement);
    const submitButton = modalElement.querySelector('[data-kt-users-modal-action="submit"]');

    // Fungsi bantu untuk menampilkan SweetAlert sukses, lalu memicu Toastr
    const showSuccessNotification = function (message, userName = '') {
        let fullMessage = userName ? `${userName} ${message}` : message;
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
                $(".kt_table_users").DataTable().ajax.reload(null, false);
            }
        });
    };

    // Fungsi bantu untuk menampilkan Toastr atau SweetAlert error
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

    const initEditUser = function () {
        $(document).on('click', '.edit-user-btn', function () {
            var userId = $(this).data('id');

            $.get('users/' + userId + '/edit', function (response) {
                $('#edit_user_id').val(userId);
                $('#edit_name').val(response.user.name);
                $('#edit_email').val(response.user.email);
                $('#edit_password').val('');

                // --- Perbaikan Utama untuk Preview Gambar ---
                const currentImage = response.user.image;
                const defaultImageUrl = 'assets/backend/media/avatars/blank.svg'; // Default avatar Anda

                let avatarPath = currentImage ? '/storage/' + currentImage : defaultImageUrl;

                // Cari elemen KTImageInput utama yang memiliki ID 'edit_avatar_input' (jika Anda memberikannya)
                // Atau cari elemen image-input-wrapper di dalam modal edit
                const imageInputWrapper = modalElement.querySelector(".image-input-wrapper");

                if (imageInputWrapper) {
                    imageInputWrapper.style.backgroundImage = `url(${avatarPath})`;
                    // Opsional: Reset status "removed" jika sebelumnya user menghapus gambar
                    const imageRemoveHiddenInput = form.querySelector('input[name="image_remove"]');
                    if (imageRemoveHiddenInput) {
                        imageRemoveHiddenInput.value = '0';
                    }
                } else {
                    console.error("Image input wrapper not found for preview.");
                }
                // --- Akhir Perbaikan Preview Gambar ---

                // Set radio button role
                if (response.role === 'Administrator') {
                    $('#edit_role_admin').prop('checked', true);
                } else {
                    $('#edit_role_viewer').prop('checked', true);
                }
                modal.show();
            }).fail(function(xhr) {
                showErrorNotification(['Failed to load user data for editing.'], false);
            });
        });
    };

    const handleFormSubmit = function () {
        if (submitButton) {
            submitButton.addEventListener("click", function (event) {
                event.preventDefault();
                let userName = $("#edit_name").val();
                let userId = $('#edit_user_id').val();

                if (typeof FormValidation !== "undefined") {
                    var validation = FormValidation.formValidation(form, {
                        fields: {
                            name: {
                                validators: {
                                    notEmpty: {
                                        message: "Full Name is required",
                                    },
                                },
                            },
                            email: {
                                validators: {
                                    notEmpty: {
                                        message: "Email is required",
                                    },
                                    emailAddress: {
                                        message: "Invalid email format",
                                    },
                                },
                            },
                            password: {
                                validators: {
                                    callback: {
                                        message: 'Password must be at least 8 characters long.',
                                        callback: function(input) {
                                            const passwordValue = input.value;
                                            if (passwordValue.length > 0 && passwordValue.length < 8) {
                                                return {
                                                    valid: false,
                                                    message: 'Password must be at least 8 characters long.'
                                                };
                                            }
                                            return true;
                                        }
                                    }
                                },
                            },
                            user_role: {
                                validators: {
                                    notEmpty: {
                                        message: "User Role is required",
                                    },
                                },
                            },
                            image: {
                                validators: {
                                    file: {
                                        extension: 'jpeg,jpg,png,gif',
                                        type: 'image/jpeg,image/png,image/gif',
                                        maxSize: 2048000, // 2MB
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
                            sendFormData(userId, userName);
                        } else {
                            showErrorNotification(["Please check the highlighted fields and try again."], false);
                        }
                    });
                } else {
                    sendFormData(userId, userName);
                }
            });
        } else {
            console.error("Submit button for edit user not found");
        }
    };

    function sendFormData(userId, userName) {
        submitButton.setAttribute("data-kt-indicator", "on");
        submitButton.disabled = true;

        const formData = new FormData(form);
        formData.append('_method', 'PUT');

        $.ajax({
            url: 'users/' + userId,
            method: 'POST',
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
                    showSuccessNotification(response.message, userName);
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
            initEditUser();
            handleFormSubmit();
        }
    };
})();

KTUsersEditUser.init();
