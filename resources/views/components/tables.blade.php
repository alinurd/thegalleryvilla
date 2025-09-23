<table class="table dataTables border-0"  >
    <thead>
    {{$thead ?? null}}
    </thead>
    <tbody>
    {{$tbody ?? null}}
    </tbody>
</table>


@push('js')
    <script>
        $( "#search" ).keyup(function() {
            var tables = $('.dataTables').DataTable();
            tables.search($('#search').val().trim()).draw();
        });


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
