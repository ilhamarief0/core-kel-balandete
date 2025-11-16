$(function () {
    const dataTableUrl = '/attendance/show';
    const bulkDeleteUrl = '/usermanagement/bulk-delete';
    var table = $('.data-tabledataabsen').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: dataTableUrl,
            data: function (d) {
                d.search = $('#searchInput').val();
            }
        },
        columns: [
            { data: 'mahasiswa' },
            { data: 'kelas' },
            { data: 'status_kehadiran' },
            { data: 'waktu_absen_masuk' },
            { data: 'waktu_absen_pulang' },
        ]
    });

    function debounce(callback, delay) {
        let timeout;
        return function () {
            clearTimeout(timeout);
            timeout = setTimeout(callback, delay);
        };
    }

    $('#searchInput').on('keyup', debounce(function () {
        table.ajax.reload();
    }, 300));

    $('#select-all').on('change', function () {
        $('.checkbox-nim').prop('checked', this.checked);
        toggleDeleteButton();
    });

    $(document).on('change', '.checkbox-nim', function () {
        var allChecked = $('.checkbox-nim').length === $('.checkbox-nim:checked').length;
        $('#select-all').prop('checked', allChecked);
        toggleDeleteButton();
    });

    function toggleDeleteButton() {
        var selected = $('.checkbox-nim:checked').length > 0;
        $('#delete-action').toggleClass('d-none', !selected);
    }

    $('#delete-selected').on('click', function () {
        var ids = $('.checkbox-nim:checked').map(function () {
            return this.value;
        }).get();

        if (ids.length > 0) {
            Swal.fire({
                text: `Are you sure you want to delete these records?`,
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light",
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: bulkDeleteUrl,
                        method: 'POST',
                        data: {
                            ids: ids,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            Swal.fire({
                                text: response.message,
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                },
                            }).then(() => {
                                table.ajax.reload();
                            });
                        },
                        error: function (xhr) {
                            const errorMsg = xhr.responseJSON?.error ||
                                "An error occurred while deleting. Please try again.";
                            Swal.fire({
                                text: errorMsg,
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                },
                            });
                        },
                    });
                }
            });
        }
    });
});
