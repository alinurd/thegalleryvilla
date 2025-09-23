<table class="table dataTables-btn">
    <thead>
    {{$thead ?? null}}
    </thead>
    <tbody>
    {{$tbody ?? null}}
    </tbody>
</table>

@push('css')
    <style>
        /*   check     */
        .dataTables-btn th:nth-child(1),
        .dataTables-btn td:nth-child(1) {
            width: 36px;
        }
        /*   no     */
        .dataTables-btn th:nth-child(2),
        .dataTables-btn td:nth-child(2) {
            width: 50px;
        }

        /*    sort    */
        .dataTables-btn th:nth-last-child(3),
        .dataTables-btn td:nth-last-child(3) {
            width: 50px;
        }
        /*    status    */
        .dataTables-btn th:nth-last-child(2),
        .dataTables-btn td:nth-last-child(2) {
            width: 60px;
        }
        /*    action    */
        .dataTables-btn th:nth-last-child(1),
        .dataTables-btn td:nth-last-child(1) {
            width: 60px;
        }
    </style>
@endpush
@push('js')
    <script>
        $(document).ready(function() {
            $('.dataTables-btn').DataTable({
                    buttons: [
                        {
                            extend: "collection",
                            className: "btn btn-label-primary dropdown-toggle me-2 waves-effect waves-light",
                            text: '<i class="ti ti-file-export me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
                            buttons: [
                                {
                                    extend: "print",
                                    text: '<i class="ti ti-printer me-1"></i>Print',
                                    className: "dropdown-item",
                                    exportOptions: {
                                        columns: {{ $exportColumns ?? '[1, 2, 3]' }}
                                    },
                                },
                                {
                                    extend: "csv",
                                    text: '<i class="ti ti-file-text me-1"></i>Csv',
                                    className: "dropdown-item",
                                    exportOptions: {
                                        columns: {{ $exportColumns ?? '[1, 2, 3]' }}
                                    },
                                },
                                {
                                    extend: "excel",
                                    text: '<i class="ti ti-file-spreadsheet me-1"></i>Excel',
                                    className: "dropdown-item",
                                    exportOptions: {
                                        columns: {{ $exportColumns ?? '[1, 2, 3]' }}
                                    },
                                },
                                {
                                    extend: "pdf",
                                    text: '<i class="ti ti-file-description me-1"></i>Pdf',
                                    className: "dropdown-item",
                                    exportOptions: {
                                        columns: {{ $exportColumns ?? '[1, 2, 3]' }}
                                    },
                                },
                                {
                                    extend: 'copy',
                                    text: '<i class="ti ti-copy me-1"></i>Copy',
                                    className: 'dropdown-item',
                                    exportOptions: {
                                        columns: {{ $exportColumns ?? '[1, 2, 3]' }},
                                    }
                                }
                            ],
                            init: function(api, node, config) {
                                $(node).addClass("d-flex justify-content-center justify-content-lg-end");
                                $(node).parent().removeClass("btn-group");
                                setTimeout(function() {
                                    $(node)
                                        .closest(".dt-buttons")
                                        .removeClass("btn-group")
                                        .addClass("d-flex justify-content-center justify-content-lg-end");
                                }, 50);
                            },
                        },
                ],
                initComplete: function() {
                    var buttonGroupHtml = `
                        <div class="btn-group float-end pl-2" role="group">
                            <button data-toggle="modal" onclick="openForm()" class="btn btn-primary">
                                <i data-feather="plus" class="me-1"></i> Add
                            </button>
                            <button onclick="actionMultiDeleteItems()" class="btn btn-danger">
                                <i data-feather="check" class="me-1"></i> Delete
                            </button>
                        </div>
                    `;
                    @isset($btnImport)
                        @if((bool)$btnImport === true)
                        var btnImport = `
                            <button class="btn btn-secondary-subtle btn-label-success me-2" onclick="openImport();" type="button"><i class="tf-icons ti ti-file-import me-2"></i> Import</button>`;
                            $("div.dt-buttons").prepend(btnImport);
                        @endif
                    @endisset
                    // Menambahkan button group ke kontainer DataTables
                    $("div.dt-buttons").append(buttonGroupHtml);
                    // feather.replace(); // Mengganti ikon Feather
                },
                dom: '<"d-flex justify-content-between align-items-center header-actions mx-2 row mt-75"' +
                '<"col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start" f>' +
                '<"col-sm-12 col-lg-8 ps-xl-75 ps-0"<"dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap"<"me-1 mb-2 mb-md-0"l>B>>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row mb-1"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
                language: {
                    sLengthMenu: '_MENU_',
                    search: 'Search',
                    searchPlaceholder: 'Search..'
                },
            });
        })


        $('#customCheckAll').change(
            function(){
                if ($(this).is(':checked')) {
                    $(".delete-checkbox").prop("checked", true);
                }else{
                    $(".delete-checkbox").prop("checked", false);
                }
        });


    </script>
@endpush
