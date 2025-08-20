$(document).ready(function () {
    // Handle the edit role button click
    $("body").on("click", ".edit-role", function () {
        var roleId = $(this).data("id"); // Ambil ID dari atribut data-id

        // Mengambil data role menggunakan AJAX
        $.ajax({
            url: `/usermanagement/roles/getData/${roleId}`,
            type: "GET",
            success: function (response) {
                if (response && response.data) {
                    // Isi data ke dalam form modal
                    $('input[name="role_name"]').val(response.data.name);

                    // Mengclear semua checkbox permissions
                    $('input[name="permissions[]"]').prop("checked", false);

                    // Check checkbox berdasarkan permissions yang ada
                    response.data.permissions.forEach(function (permission) {
                        $(
                            'input[name="permissions[]"][value="' +
                                permission.name +
                                '"]'
                        ).prop("checked", true);
                    });

                    // Tampilkan modal edit
                    $("#kt_modal_edit_roles").modal("show");

                    // Set the role ID in the form for submission (using hidden input)
                    $('#kt_modal_edit_roles_form input[name="role_id"]').val(
                        roleId
                    );
                }
            },
            error: function (xhr) {
                console.error(
                    "An error occurred while fetching role data: ",
                    xhr.responseText
                );
            },
        });
    });

    // Submit handler for the update role form
    const submitButton = document.querySelector(
        '[data-kt-editroles-modal-action="submit"]'
    );
    const form = document.getElementById("kt_modal_edit_roles_form");

    if (submitButton) {
        submitButton.addEventListener("click", function (event) {
            event.preventDefault();

            // Get role_id from the hidden input field in the form
            let roleId = $('input[name="role_id"]').val();
            let roleName = $('input[name="role_name"]').val();

            const handleFormSubmit = function () {
                submitButton.setAttribute("data-kt-indicator", "on");
                submitButton.disabled = true;

                // AJAX request to submit the form data
                $.ajax({
                    type: "POST",
                    url: `/usermanagement/roles/update/${roleId}`,
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
                            text: `Role ${roleName} Berhasil Di Update!`,
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            },
                        }).then(function (result) {
                            if (result.isConfirmed) {
                                // Refresh UI (you might want to update the role list dynamically here)
                                location.reload();
                                $("#kt_modal_edit_roles").modal("hide");
                            }
                        });
                    },
                    error: function (xhr, status, error) {
                        submitButton.removeAttribute("data-kt-indicator");
                        submitButton.disabled = false;

                        // More detailed error handling
                        var errorMessage = "Terjadi Kesalahan!";
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        } else if (xhr.responseText) {
                            errorMessage += " " + xhr.responseText;
                        }

                        Swal.fire({
                            text: errorMessage,
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
            if (typeof o !== "undefined" && o.validate) {
                o.validate().then(function (status) {
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
    const resetButton = document.querySelector(
        '[data-kt-reseteditcustomer-modal-action="cancel"]'
    );

    resetButton.addEventListener("click", function (event) {
        event.preventDefault();
        Swal.fire({
            text: "Are you sure you would like to cancel?",
            icon: "warning",
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonText: "Yes, cancel it!",
            cancelButtonText: "No, return",
            customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-active-light",
            },
        }).then(function (result) {
            form.reset();
            $("#kt_modal_edit_roles").modal("hide");
        });
    });

    const resetatasButton = document.querySelector(
        '[data-kt-roles-modal-action="close"]'
    );

    resetatasButton.addEventListener("click", function (event) {
        event.preventDefault();
        Swal.fire({
            text: "Are you sure you would like to cancel?",
            icon: "warning",
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonText: "Yes, cancel it!",
            cancelButtonText: "No, return",
            customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-active-light",
            },
        }).then(function (result) {
            form.reset();
            $("#kt_modal_edit_client").modal("hide");
        });
    });
});
