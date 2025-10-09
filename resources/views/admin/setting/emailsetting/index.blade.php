@extends('admin.layouts.app', ['title' => 'Email Settings', 'ckeditor' => true])

@section('content')
    <div class="card shadow">
        <div class="card-body pl-0 pr-0">


            <div class="row p-2">
                <div class="col-12">
                    <h3><b>Email Settings</b></h3>
                </div>

            </div>
            <ul class="nav nav-tabs mb-1" id="languageTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="btn-en"onclick="setLang('en')" data-bs-toggle="tab"
                        data-bs-target="#template" type="button" role="tab"> Template
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="btn-id" onclick="setLang('id')" data-bs-toggle="tab"
                        data-bs-target="#outbox" type="button" role="tab"> Outbox
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="template" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group mb-3"> 
                                <textarea id="email_template" class="form-control" placeholder="email_template" aria-label="email_template"aria-describedby="email_template"name="email_template" required>
                                    @if ($data != null){{ $data->email_template }}@endif
                                </textarea>
                            </div>

                            <div class="row mt-3">
                            <div class="col-12 d-flex justify-content-end">
                                <div>
                                    <button type="button" id='submit' onclick="saveData()"
                                    class="btn btn-outline-primary">
                                        <div id="simpan" class="">
                                            <i data-feather="save" class="me-1"></i> Simpan
                                        </div>
                                        <div id="loading" class="hidden">
                                            <span class="spinner-border spinner-border-sm"
                                                role="status" aria-hidden="true"></span>
                                            <span class="">Loading...</span>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>

                            

                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show" id="outbox" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <td>No</td>
                                    <td>SUbject</td>
                                    <td>Email_template</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')
    <script>
        CKEDITOR.replace('email_template', CKEDITORGlobalOptions);

        $('.switch-input').change(function() {
            let my = $(this).attr('id');
            let lastVal = $('#' + my).val();

            if (parseInt(lastVal) == 1) {
                $('#' + my).val('0');
            } else {
                $('#' + my).val('1');
            }
        })


        //save data

        function saveData() {
            hasEmptyRequiredForm = false;
            $('#formData .form-control, #formData .switch-input').filter('[required]:visible').each(function() {
                if ($(this).val() == null || $(this).val() == "") {
                    hasEmptyRequiredForm = true;
                }
            })

            if (hasEmptyRequiredForm) {
                swAlertDialog('error', 'Silakan isi semua formulir');
            } else {
                const jsonData = {};
                $('#formData .form-control, #formData .switch-input').each(function() {
                    let key = $(this).attr('name');
                    let val = $(this).val().trim();
                    jsonData[key] = val;
                });
                jsonData['email_template'] = CKEDITOR.instances['email_template'].getData();

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.setting.emailsetting.save') }}",
                    data: jsonData,
                    dataType: 'json',
                    beforeSend: function() {
                        $('#submit').prop('disabled', true);
                        $('#loading').removeClass('hidden');
                        $('#simpan').addClass('hidden');
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            swAlertDialog('success', 'Data berhasil disimpan');
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        } else {
                            swAlertDialog('error', res.message);
                            $('#submit').prop('disabled', false);
                            $('#loading').addClass('hidden');
                            $('#simpan').removeClass('hidden');
                        }
                    }

                });
            }

        }

        function onlyNumberKey(evt) {

            // Only ASCII character in that range allowed
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
                return false;
            return true;
        }
    </script>
@endpush
