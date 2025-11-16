"use strict";

var KTBannerDelete = (function () {
    const DeleteUrl = 'banner/delete';
    const showSuccess = function (message) {
        Swal.fire({
            text: message,
            icon: "success",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
                confirmButton: "btn btn-primary",
            },
        }).then((result) => {
            if (result.isConfirmed) {
                toastr.success(message, 'Success');
            }
        });
    };

    // Fungsi untuk menampilkan SweetAlert error
    const showError = function (message) {
        Swal.fire({
            text: message,
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
                confirmButton: "btn btn-primary",
            },
        });
    };

    const handleDeleteSelected = function () {
        $('#delete-selected').on('click', function () {
            const ids = $('.checkbox-nim:checked').map(function () {
                return this.value;
            }).get();

            if (ids.length === 0) {
                toastr.warning('Please select at least one user to delete.', 'Warning');
                return;
            }

            Swal.fire({
                text: `Apakah Anda yakin ingin menghapus ${ids.length} data ini?`,
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Tidak, batalkan",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light",
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: DeleteUrl,
                        method: 'POST',
                        data: {
                            ids: ids,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            if (response.status === 'success') {
                                showSuccess(response.message);
                                $(".kt_table_banner").DataTable().ajax.reload(null, false);
                                $('#delete-action').addClass('d-none');
                                $('#add-banner').removeClass('d-none');
                                $('#select-all').prop('checked', false);
                            } else {
                                showError(response.message || "An unknown success response occurred.");
                            }
                        },
                        error: function (xhr) {
                            const errorMsg = xhr.responseJSON?.error || "Terjadi kesalahan saat menghapus. Silakan coba lagi.";
                            showError(errorMsg);
                        }
                    });
                }
            });
        });
    };

    const handleDeleteSingle = function () {
        $(document).on('click', '.delete-user', function (e) {
            e.preventDefault();
            const userId = $(this).data('id');

            Swal.fire({
                text: `Apakah Anda yakin ingin menghapus pengguna ini?`,
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Tidak, batalkan",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light",
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: DeleteUrl,
                        method: 'POST',
                        data: {
                            ids: [userId],
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            if (response.status === 'success') {
                                showSuccess(response.message);
                                $(".kt_table_users").DataTable().ajax.reload(null, false);
                            } else {
                                showError(response.message || "An unknown success response occurred.");
                            }
                        },
                        error: function (xhr) {
                            const errorMsg = xhr.responseJSON?.error || "Gagal menghapus pengguna. Silakan coba lagi.";
                            showError(errorMsg);
                        }
                    });
                }
            });
        });
    };

    return {
        init: function () {
            handleDeleteSelected();
            handleDeleteSingle();
        }
    };
})();

KTBannerDelete.init();
