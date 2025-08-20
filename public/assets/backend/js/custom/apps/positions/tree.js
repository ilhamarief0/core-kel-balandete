"use strict";

var KTJabatanTree = (function () {
    var initNestable = function () {
        // Inisialisasi Nestable utama untuk DIVISI
        $('#nestable-divisions').nestable({
            maxDepth: 1 // Divisi tidak bisa bersarang di dalam divisi lain, hanya bisa diurutkan
        }).on('change', function () {
            var list = $(this).nestable('serialize');
            if (list === false || list === null) {
                list = [];
            }
            // Kirim data urutan divisi ke backend
            $.ajax({
                url: '/backend/jabatan/update-division-order', // Rute baru untuk urutan divisi
                type: 'POST',
                data: JSON.stringify({
                    data: list,
                    _token: $('meta[name="csrf-token"]').attr('content')
                }),
                contentType: 'application/json',
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        toastr.success(response.message, 'Success');
                    } else {
                        toastr.error(response.error || 'Gagal memperbarui urutan divisi.', 'Error');
                    }
                },
                error: function (xhr) {
                    let errorMessage = xhr.responseJSON && xhr.responseJSON.error ? xhr.responseJSON.error : "Terjadi kesalahan saat memperbarui urutan divisi.";
                    toastr.error(errorMessage, 'Error');
                }
            });
        });

        // Inisialisasi Nestable untuk JABATAN di dalam setiap divisi
        // Menggunakan delegasi event untuk Nestable yang dinamis
        $('.dd-list').each(function() {
            // Hanya inisialisasi Nestable pada dd-list yang merupakan anak langsung dari dd-item (jabatan atau divisi)
            // dan bukan dd-list dari Nestable utama
            if ($(this).closest('.dd').attr('id') !== 'nestable-divisions') {
                $(this).nestable({
                    maxDepth: 10 // Kedalaman jabatan bisa lebih dalam
                }).on('change', function () {
                    var list = $(this).nestable('serialize');
                    if (list === false || list === null) {
                        list = [];
                    }
                    // Kirim data urutan jabatan ke backend
                    $.ajax({
                        url: '/backend/jabatan/update-order', // Rute lama untuk urutan jabatan
                        type: 'POST',
                        data: JSON.stringify({
                            data: list,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        }),
                        contentType: 'application/json',
                        dataType: 'json',
                        success: function (response) {
                            if (response.status === 'success') {
                                toastr.success(response.message, 'Success');
                                // Memastikan Select2 di modal Add/Edit diperbarui
                                if (typeof KTJabatanAdd !== 'undefined') KTJabatanAdd.initSelect2();
                                if (typeof KTJabatanEdit !== 'undefined') KTJabatanEdit.initSelect2();
                            } else {
                                toastr.error(response.error || 'Gagal memperbarui urutan jabatan.', 'Error');
                            }
                        },
                        error: function (xhr) {
                            let errorMessage = xhr.responseJSON && xhr.responseJSON.error ? xhr.responseJSON.error : "Terjadi kesalahan saat memperbarui urutan jabatan.";
                            toastr.error(errorMessage, 'Error');
                        }
                    });
                });
            }
        });
    };

    var handleSearch = function () {
        $('#searchInput').on('keyup', function () {
            var searchText = $(this).val().toLowerCase();

            // Sembunyikan semua item Nestable dan header divisi
            $('.dd-item').hide();
            // $('.dd').hide(); // Tidak perlu menyembunyikan Nestable utama
            // $('h4.text-primary, h4.text-secondary').hide(); // Ini sudah menjadi bagian dari dd-handle

            // Iterasi melalui setiap item Nestable jabatan untuk menampilkan yang cocok
            $('.dd-item[data-type!="division"][data-type!="no-division"]').each(function () {
                var itemName = $(this).find('.dd-handle').first().text().toLowerCase();
                if (itemName.includes(searchText)) {
                    $(this).show();
                    // Pastikan parent (dd-list dan dd-item induk) juga terlihat
                    $(this).parents('.dd-item').show();
                    $(this).parents('.dd-list').show();
                    // Pastikan item divisi induk juga terlihat
                    $(this).closest('.dd-item[data-type="division"], .dd-item[data-type="no-division"]').show();
                }
            });

            // Jika searchbox kosong, tampilkan semua seperti semula
            if (searchText === '') {
                $('.dd-item').show();
            }

            // Expand semua Nestable untuk melihat hasil pencarian
            $('.dd').nestable('expandAll');
        });
    };

    var handleDeleteButtons = function () {
        $(document).on('click', '.delete-jabatan-btn', function (event) {
            event.stopImmediatePropagation();
            event.preventDefault();

            var id = $(this).data('id');
            var name = $(this).data('name');

            Swal.fire({
                text: "Apakah kamu yakin ingin menghapus jabatan " + name + "?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        url: '/backend/jabatan/' + id,
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    text: response.message,
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, Got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                }).then(function () {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    text: response.error,
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, Got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                });
                            }
                        },
                        error: function (xhr) {
                            let errorMessage = xhr.responseJSON && xhr.responseJSON.error ? xhr.responseJSON.error : "Terjadi kesalahan saat menghapus.";
                            Swal.fire({
                                text: errorMessage,
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, Got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            });
                        }
                    });
                }
            });
        });
    };

    var handleEditButtons = function () {
        $(document).on('click', '.edit-jabatan-btn', function (event) {
            event.stopImmediatePropagation();
            event.preventDefault();

            var id = $(this).data('id');
            var name = $(this).data('name');
            var parentId = $(this).data('parent-id');
            var divisionId = $(this).data('division-id');

            $('#kt_modal_edit_jabatan').modal('show');
            $('#edit_jabatan_id').val(id);
            $('#jabatan_name_edit').val(name);
            $('#jabatan_parent_edit').val(parentId).trigger('change');
            $('#jabatan_division_edit').val(divisionId).trigger('change');
        });
    };

    return {
        init: function () {
            initNestable();
            handleSearch();
            handleDeleteButtons();
            handleEditButtons();
        }
    };
})();

// On document ready
$(function () {
    KTJabatanTree.init();
});

