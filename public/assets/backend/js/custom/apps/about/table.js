"use strict";

var KTNewsList = (function () {
    const dataTableUrl = 'about/dataTable';
    let table;

    const initTable = function () {
        table = $('.kt_table_about').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: dataTableUrl,
                data: function (d) {
                    d.search = $('#searchInput').val();
                }
            },
            columns: [
                { data: 'view' },
                { data: 'images', orderable: false, searchable: false },
                { data: 'title' },
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
                toggleDeleteButton();
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
        $('#add-news').toggleClass('d-none', selected);
    };

    return {
        init: function () {
            initTable();
            handleSearch();
            handleCheckboxSelection();
        }
    };
})();

KTNewsList.init();
