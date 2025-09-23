<div class="mb-1">
    <label class="form-label"
        for="{{ ucwords($name ?? null) }}">{{ ucwords(str_replace('_', ' ', $label ?? $name)) }}</label>
    @if ($type == 'password')
        <div class="input-group form-password-toggle input-group-merge">
            <input type="{{ $type ?? 'text' }}" class="form-control" {{ $attributes }} id="form-{{ $name }}"
                placeholder="{{ ucwords(str_replace('_', ' ', $placeholder ?? $name)) }}" name="{{ $name ?? null }}"
                value="{{ $value ?? null }}" />
            <div class="input-group-text cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-eye-off font-small-4">
                    <path
                        d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24">
                    </path>
                    <line x1="1" y1="1" x2="23" y2="23"></line>
                </svg>
            </div>
        </div>
    @else
        <input type="{{ $type ?? 'text' }}" class="form-control"  id="form-{{ $name }}"
            placeholder="{{ ucwords(str_replace('_', ' ', $placeholder ?? $name)) }}" name="{{ $name ?? null }}"
            value="{{ $value ?? null }}" {{ $attributes }}/>
    @endif
    <small id="form-error-{{ $name }}" class="form-error text-danger"></small>
    @if ($type == 'file')
        <img id="image-{{ $name }}" class="mt-1 hidden" src="#" alt="your image" />
    @endif
</div>

@push('js')
    @if ($type == 'file')
        <script>
            $(`#form-{{ $name }}`).on('change', function() {
                if (this.files && this.files[0]) {
                    var filesToUpload = this.files;
                    var file = filesToUpload[0];
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var image = new Image();
                        image.src = e.target.result;
                        image.onload = function() {
                            var ratio = Math.min(150 / this.width, 150 / this.height);
                            $(`#image-{{ $name }}`).attr('src', e.target.result)
                                .width(this.width * ratio)
                                .height(this.height * ratio)
                                .removeClass('hidden')
                        };
                    };
                    reader.readAsDataURL(file);
                }
            })
        </script>
    @endif
@endpush
