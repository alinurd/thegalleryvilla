@php
if (str_contains($name, '[]')) {
    $multiple = str_replace('[]', '', $name);
}
@endphp
<div class="mb-1">
    <label class="form-label" for="{{ $multiple ?? $name }}">{{ ucwords(str_replace('_', ' ', $multiple ?? $label ?? $name  )) }}</label>
    @if (isset($btnBrowser))
        <div class="row">
            <div class="{{!$btnBrowser ? 'col-md-12' : 'col-md-9'}}">
                <input type="hidden" id="form-{{ $multiple ?? $name }}" class="form-control " name="{{ $name }}"
                    {{ $attributes }} />
                <input type="text" id="form-{{ $multiple ?? $name }}-text" class="form-control"
                    placeholder="{{ $placeholder ?? null }}" name="{{ $name }}-text" {{ $attributes }} />
            </div>
            @if ($btnBrowser)
            <div class="col-md-3">
                {{ $slot ?? null }}
            </div>
            @endif
        </div>
    @else
        <select id="form-{{ $multiple ?? $name }}" class="form-select" name="{{ $name }}"
            {{ $attributes }}>
            <option disabled selected>Select {{ ucwords(str_replace('_', ' ', $multiple ?? $name)) }}</option>
            {{ $slot ?? null }}
        </select>
    @endif
    <small id="form-error-{{ $multiple ?? $name }}" class="form-error text-danger"></small>
</div>
