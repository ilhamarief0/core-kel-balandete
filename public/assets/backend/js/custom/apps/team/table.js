"use strict";

var KTTeamList = (function () {
    const dataTableUrl = 'team/dataTable';
    let table;

    const initTable = function () {
        table = $('.kt_table_team').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: dataTableUrl,
                data: function (d) {
                    d.search = $('#searchInput').val();
                }
            },
            columns: [
                {
                    data: 'id',
                    render: function (data) {
                        return `
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input checkbox-nim" type="checkbox" value="${data}" />
                            </div>
                        `;
                    },
                    orderable: false,
                    searchable: false
                },
                { data: 'profile', orderable: false, searchable: false },
                { data: 'position' },
                { data: 'created_at' },
                {
                    data: 'actions',
                    orderable: false,
                    searchable: false
                }
            ],
            drawCallback: function () {
                if (typeof KTMenu !== 'undefined' && KTMenu.createInstances) {
                    KTMenu.createInstances();
                }
                toggleDeleteButton(); // Panggil ini setelah tabel digambar ulang
            }
        });
    };

    const debounce = function (callback, delay) {
        let timeout;
        return function () {
            clearTimeout(timeout);
            timeout = setTimeout(callback, delay);
        };
    };

    const handleSearch = function () {
        $('#searchInput').on('keyup', debounce(function () {
            table.ajax.reload();
        }, 300));
    };

    const handleCheckboxSelection = function () {
        $('#select-all').on('change', function () {
            $('.checkbox-nim').prop('checked', this.checked);
            toggleDeleteButton();
        });

        $(document).on('change', '.checkbox-nim', function () {
            const allChecked = $('.checkbox-nim').length === $('.checkbox-nim:checked').length;
            $('#select-all').prop('checked', allChecked);
            toggleDeleteButton();
        });
    };

    const toggleDeleteButton = function () {
        const selected = $('.checkbox-nim:checked').length > 0;
        $('#delete-action').toggleClass('d-none', !selected);
        $('#add-user').toggleClass('d-none', selected);
    };

    const showSuccess = function (message) {
        Swal.fire({
            text: message,
            icon: "success",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
                confirmButton: "btn btn-primary",
            },
        });
    };

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

    return {
        init: function () {
            initTable();
            handleSearch();
            handleCheckboxSelection();
            // showSuccess dan showError tidak perlu dipanggil di init karena mereka adalah helper functions
            // yang akan dipanggil oleh modul lain atau di dalam event handler
        }
    };
})();

KTTeamList.init();
