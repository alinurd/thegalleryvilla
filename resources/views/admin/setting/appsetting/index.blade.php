@extends('admin.layouts.app', ['title' => 'App Settings', 'ckeditor' => true])

@section('content')
    <div class="card shadow">
        <div class="card-body pl-0 pr-0">


            <div class="row p-2">
                <div class="col-12">
                    <h3><b>App Settings</b></h3>
                </div>

            </div>

            <div class="row p-2">
                <div class="col-12">
                    <form class="form" id="formData">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="form-label" for="title">Website Title</label>
                            <input type="text" id="title" name="title" class="form-control"
                                placeholder="Title Website" aria-label="title" aria-describedby="title"
                                value="@if ($data != null) {{ $data->title }} @endif" required />
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="footer_text">Footer Text</label>
                            <textarea id="footer_text" class="form-control" placeholder="Footer Text" name="footer_text"
                                aria-label="footer_text" aria-describedby="footer_text" required />@if ($data != null) {{ $data->footer_text }} @endif </textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="meta_keyword">Meta Keyword</label>
                            <input type="text" id="meta_keyword" class="form-control"
                                value="@if ($data != null) {{ $data->meta_keyword }} @endif"
                                placeholder="Keywords" aria-label="meta_keyword" name="meta_keyword"
                                aria-describedby="meta_keyword" required />
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="meta_description">Meta Description</label>
                            <textarea name="meta_description"
                                class="form-control" placeholder="Description" aria-label="meta_description"
                                aria-describedby="meta_description" required>@if ($data != null) {{ $data->meta_description }} @endif</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="address">Address</label>
                            <textarea id="address" class="form-control" placeholder="Address" aria-label="address" aria-describedby="address"
                                name="address" required>@if ($data != null) {{ $data->address }} @endif</textarea>
                        </div>

                        <hr>

                        <h4 class="card-title">Contacts</h4>

                        <div class="form-group mb-3">
                            <label class="form-label" for="website">Website</label>
                            <input type="text" id="website" class="form-control"
                                value="@if ($data != null) {{ $data->website }} @endif"
                                placeholder="website" aria-label="website" name="website"
                                aria-describedby="website" required />
                        </div>


                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-6 mb-3">
                                    <label class="form-label" for="telephone">Telephone</label>
                                    <input type="text" id="telephone" class="form-control"
                                        onkeypress="return onlyNumberKey(event)" placeholder="Telephone"
                                        aria-label="telephone" name="telephone"
                                        value="@if ($data != null) {{ $data->telephone }} @endif"
                                        aria-describedby="telephone" required />
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="text" id="email" name="email" class="form-control"
                                        placeholder="Email" aria-label="email" aria-describedby="email"
                                        value="@if ($data != null) {{ $data->email }} @endif"
                                        required />
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="row">
                                <div class="col-12 col-md-6 mb-3">
                                    <label class="form-label" for="mobile_phone">Mobile Phone</label>
                                    <input type="text" id="mobile_phone" class="form-control" placeholder="Mobile Phone"
                                        aria-label="Mobile Phone" name="mobile_phone"
                                        onkeypress="return onlyNumberKey(event)"
                                        value="@if ($data != null) {{ $data->mobile_phone }} @endif"
                                        aria-describedby="Mobile Phone" required />
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label class="form-label" for="whatsapp">WhatsApp Number</label>
                                    <input type="text" id="whatsapp" class="form-control"
                                        value="@if ($data != null) {{ $data->whatsapp }} @endif"
                                        placeholder="whatsapp" aria-label="whatsapp" name="whatsapp"
                                        aria-describedby="whatsapp" required />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title">Social Media</h4>

                                <div class="form-group">
                                    <label class="form-label" for="facebook">Facebook</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <label class="switch switch-primary pe-4">
                                                <input type="checkbox" class="switch-input" name="status_facebook"
                                                    id="status_facebook" {!! $data?->status_facebook == 1 ? 'value="1" checked' : 'value="0"' !!}>
                                                <span class="switch-toggle-slider">
                                                    <span class="switch-on">
                                                    <i class="ti ti-check"></i>
                                                    </span>
                                                    <span class="switch-off">
                                                    <i class="ti ti-x"></i>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                        <input type="text" class="form-control" id="facebook" placeholder="Facebook" name="facebook" value="{{ $data?->facebook }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="twitter">Twitter</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <label class="switch switch-primary pe-4">
                                                <input type="checkbox" class="switch-input" name="status_twitter"
                                                    id="status_twitter" {!! $data?->status_twitter == 1 ? 'value="1" checked' : 'value="0"' !!}>
                                                <span class="switch-toggle-slider">
                                                    <span class="switch-on">
                                                    <i class="ti ti-check"></i>
                                                    </span>
                                                    <span class="switch-off">
                                                    <i class="ti ti-x"></i>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                        <input type="text" class="form-control" id="twitter" placeholder="Twitter" name="twitter" value="{{ $data?->twitter }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="youtube">YouTube</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <label class="switch switch-primary pe-4">
                                                <input type="checkbox" class="switch-input" name="status_youtube"
                                                    id="status_youtube" {!! $data?->status_youtube == 1 ? 'value="1" checked' : 'value="0"' !!}>
                                                <span class="switch-toggle-slider">
                                                    <span class="switch-on">
                                                    <i class="ti ti-check"></i>
                                                    </span>
                                                    <span class="switch-off">
                                                    <i class="ti ti-x"></i>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                        <input type="text" class="form-control" id="youtube" placeholder="YouTube" name="youtube" value="{{ $data?->youtube }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="instagram">Instagram</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <label class="switch switch-primary pe-4">
                                                <input type="checkbox" class="switch-input" name="status_instagram"
                                                    id="status_instagram" {!! $data?->status_instagram == 1 ? 'value="1" checked' : 'value="0"' !!}>
                                                <span class="switch-toggle-slider">
                                                    <span class="switch-on">
                                                    <i class="ti ti-check"></i>
                                                    </span>
                                                    <span class="switch-off">
                                                    <i class="ti ti-x"></i>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                        <input type="text" class="form-control" id="instagram" placeholder="Instagram" name="instagram" value="{{ $data?->instagram }}">
                                    </div>
                                </div>



                                <div class="form-group" style="display:none">
                                    <label class="form-label" for="tiktok">TikTok</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <label class="switch switch-primary pe-4">
                                                <input type="checkbox" class="switch-input" name="status_tiktok"
                                                    id="status_tiktok" {!! $data?->status_tiktok == 1 ? 'value="1" checked' : 'value="0"' !!}>
                                                <span class="switch-toggle-slider">
                                                    <span class="switch-on">
                                                    <i class="ti ti-check"></i>
                                                    </span>
                                                    <span class="switch-off">
                                                    <i class="ti ti-x"></i>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                        <input type="text" class="form-control" id="tiktok" placeholder="TikTok" name="tiktok" value="{{ $data?->tiktok }}">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col mb-3">
                                <div class="border rounded p-2">
                                    <label class="form-label mb-1">Website Logo</label>
                                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center px-3">
                                        <div id="holder-logo" class="mb-1 mb-md-0">
                                            <img src="{{ ($data?->logo ? asset($data->logo) : asset('assets/img/noimage.jpg')) }}" style="max-height: 110px; width:100%;" alt="Featured Image">
                                        </div>
                                        <div>
                                            <small class="text-muted">
                                            Recomended Resolution 300 x 150 pixel</small>
                                            <div class="input-group">
                                                <a data-input="thumbnail-logo" data-preview="holder-logo" class="btn btn-primary text-white lfm">
                                                    <i class="menu-icon tf-icons ti ti-photo"></i> Choose
                                                </a>
                                                <input id="thumbnail-logo" class="form-control bg-secondary-subtle" type="text" name="logo" value="{{$data?->logo}}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <div class="border rounded p-2">
                                    <label class="form-label mb-1">Website Icon</label>
                                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center px-3">
                                        <div id="holder-icon" class="mb-1 mb-md-0"><img src="{{ ($data?->favicon ? asset($data->favicon) : asset('assets/img/noimage.jpg')) }}" style="max-height: 110px; width:100%;" alt="Featured Image"></div>
                                        <div>
                                            <small class="text-muted">
                                            Recomended Resolution 400 x 400 pixel</small>
                                            <div class="input-group">
                                                <a data-input="thumbnail-icon" data-preview="holder-icon" class="btn btn-primary text-white lfm">
                                                    <i class="menu-icon tf-icons ti ti-photo"></i> Choose
                                                </a>
                                                <input id="thumbnail-icon" class="form-control bg-secondary-subtle" type="text" name="favicon" value="{{$data?->favicon}}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection


@push('js')
    <script>
        CKEDITOR.replace('address', CKEDITORGlobalOptions);

        $('.switch-input').change(function() {
            let my = $(this).attr('id');
            let lastVal = $('#' + my).val();

            if(parseInt(lastVal) == 1){
                $('#' + my).val('0');
            } else {
                $('#' + my).val('1');
            }
        })


        //save data

        function saveData() {
            hasEmptyRequiredForm = false;
            $('#formData .form-control, #formData .switch-input').filter('[required]:visible').each(function() {
                if($(this).val() == null || $(this).val() == "") {
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
                jsonData['address'] = CKEDITOR.instances['address'].getData();

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.setting.appsetting.save') }}",
                    data: jsonData,
                    dataType: 'json',
                    beforeSend: function() {
                        $('#submit').prop('disabled', true);
                        $('#loading').removeClass('hidden');
                        $('#simpan').addClass('hidden');
                    },
                    success: function(res) {
                        if(res.status == 'success') {
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
