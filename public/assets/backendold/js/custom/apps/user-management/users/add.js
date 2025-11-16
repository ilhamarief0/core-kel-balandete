"use strict";

var KTUsersAddUser = (function () {
    const modalElement = document.getElementById("kt_modal_add_users");
    const form = modalElement.querySelector("#kt_modal_add_users_form");
    const modal = new bootstrap.Modal(modalElement);
    const submitButton = modalElement.querySelector('[data-kt-users-modal-action="submit"]');

    // Fungsi bantu untuk menampilkan SweetAlert sukses, lalu memicu Toastr
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
                // Tampilkan Toastr setelah SweetAlert dikonfirmasi
                toastr.success(fullMessage, 'Success');
                form.reset(); // Reset form hanya setelah sukses
                modal.hide(); // Sembunyikan modal hanya setelah sukses
                $(".kt_table_users").DataTable().ajax.reload(); // Refresh DataTable
            }
        });
    };

    // Fungsi bantu untuk menampilkan Toastr atau SweetAlert error
    const showErrorNotification = function (messages, isValidationError = false) {
        if (isValidationError) {
            // Jika ini error validasi, tampilkan semua pesan dengan Toastr
            messages.forEach(msg => {
                toastr.error(msg, 'Validation Error');
            });
        } else {
            // Jika error umum, gunakan SweetAlert
            Swal.fire({
                text: messages[0] || "Terjadi kesalahan!", // Ambil pesan pertama atau pesan default
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn btn-primary",
                },
            });
            toastr.error(messages[0] || "An error occurred.", 'Error'); // Tambahkan juga toastr untuk error umum
        }
    };


    if (submitButton) {
        submitButton.addEventListener("click", function (event) {
            event.preventDefault();

            // Mendapatkan nilai nama client (jika ada) untuk pesan sukses
            let clientName = $("#kt_modal_add_users_form input[name='name']").val(); // Ambil dari input name

            const handleFormSubmit = function () {
                submitButton.setAttribute("data-kt-indicator", "on");
                submitButton.disabled = true;

                const formData = new FormData(form);

                $.ajax({
                    type: "POST",
                    url: "users",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function (response) {
                        submitButton.removeAttribute("data-kt-indicator");
                        submitButton.disabled = false;

                        // Periksa status dari respons JSON
                        if (response.status === 'success') {
                            showSuccessNotification(response.message, clientName);
                        } else {
                            // Ini seharusnya tidak terjadi jika controller mengembalikan status 'success'
                            // Tapi sebagai fallback jika response.status bukan 'success'
                            showErrorNotification([response.message || "Something went wrong on success, but not an error."], false);
                        }
                    },
                    error: function (xhr) {
                        submitButton.removeAttribute("data-kt-indicator");
                        submitButton.disabled = false;

                        let errorMessages = [];
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            // Ini adalah error validasi dari Laravel
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                errorMessages.push(value[0]);
                            });
                            showErrorNotification(errorMessages, true); // True menandakan error validasi
                        } else if (xhr.responseJSON && xhr.responseJSON.error) {
                            // Ini adalah error umum dari controller (misal dari try-catch)
                            errorMessages.push(xhr.responseJSON.error);
                            showErrorNotification(errorMessages, false);
                        } else {
                            // Error tidak dikenal
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
                        name: {
                            validators: {
                                notEmpty: {
                                    message: "Nama is required",
                                },
                            },
                        },
                        email: { // Tambahkan validasi email
                            validators: {
                                notEmpty: {
                                    message: "Email is required",
                                },
                                emailAddress: {
                                    message: "The value is not a valid email address",
                                },
                            },
                        },
                        password: { // Tambahkan validasi password
                            validators: {
                                notEmpty: {
                                    message: "Password is required",
                                },
                                // Anda bisa menambahkan validasi password lainnya di sini (min length, dll.)
                            },
                        },
                        user_role: { // Tambahkan validasi role
                            validators: {
                                notEmpty: {
                                    message: "User Role is required",
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
