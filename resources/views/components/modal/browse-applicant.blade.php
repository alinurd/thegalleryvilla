<div class="modal fade" id="modalBrowseApplicant" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Browse Applicant {{ $roleName ?? '' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="table-browse-applicant" style="width: 100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function () {
            $('#table-browse-applicant').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("admin.applicant.profile.browse-applicant-data") }}',
                columns: [
                    { data: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'profile.idcode' },
                    { data: 'name' },
                    { data: 'email' },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });

        function selectApplicant(applicantId, idcode, name, email, mobile_phone) {
            $('#applicant_profile_id').val(applicantId);
            $('#applicant_idcode').val(idcode);
            $('#user_name').val(name);
            $('#user_email').val(email);
            $('#user_mobile_phone').val(mobile_phone);
            $('#modalBrowseApplicant').modal('hide');
        }
    </script>
@endpush
