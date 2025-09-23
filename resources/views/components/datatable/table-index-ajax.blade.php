<div class="table-responsive">
    <table class="table" id="dt-index-{{ $id }}">
        <thead>
            <tr>
                @foreach ($headers as $header)
                    <th>{!! $header !!}</th>
                @endforeach
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

@push('js')
<script>
    $(document).ready(function() {
        $('#customCheckAll').change(
            function(){
                if ($(this).is(':checked')) {
                    $(".delete-checkbox").prop("checked", true);
                }else{
                    $(".delete-checkbox").prop("checked", false);
                }
        });
        $('#dt-index-{{ $id }}').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ $ajax }}',
            columns: {!! $columns !!},
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
                            exportOptions: { columns: {!! $exportColumns !!} },
                        },
                        {
                            extend: "csv",
                            text: '<i class="ti ti-file-text me-1"></i>Csv',
                            className: "dropdown-item",
                            exportOptions: { columns: {!! $exportColumns !!} },
                        },
                        {
                            extend: "excel",
                            text: '<i class="ti ti-file-spreadsheet me-1"></i>Excel',
                            className: "dropdown-item",
                            exportOptions: { columns: {!! $exportColumns !!} },
                        },
                        {
                            extend: "pdf",
                            text: '<i class="ti ti-file-description me-1"></i>Pdf',
                            className: "dropdown-item",
                            exportOptions: { columns: {!! $exportColumns !!} },
                        },
                        {
                            extend: 'copy',
                            text: '<i class="ti ti-copy me-1"></i>Copy',
                            className: 'dropdown-item',
                            exportOptions: { columns: {!! $exportColumns !!} },
                        }
                    ],
                },
            ],
            dom: '<"d-flex justify-content-between align-items-center header-actions mx-2 row mt-75"' +
                '<"col-sm-12 col-lg-3 d-flex justify-content-center justify-content-lg-start" f>' +
                '<"col-sm-12 col-lg-9 ps-xl-75 ps-0"<"dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap"<"me-1 mb-2 mb-md-0"l>B>>' +
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
            initComplete: function() {
                $("div.dt-buttons").append(`
                    <div class="btn-group float-end pl-2" role="group">
                        <button data-toggle="modal" onclick="openForm()" class="btn btn-primary">
                            <i class="ti ti-plus me-1"></i> Add
                        </button> &nbsp;
                        <button onclick="actionMultiDeleteItems()" class="btn btn-danger">
                            <i class="ti ti-trash me-1"></i> Delete
                        </button>
                    </div>
                `);
            }
        });
    });
</script>
@endpush
