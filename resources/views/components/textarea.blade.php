<div class="mb-1">
    <label class="form-label"
        for="{{ ucwords($name ?? null) }}">{{ ucwords(str_replace('_', ' ', $label ?? $name)) }}</label>

    <textarea class="form-control"  id="form-{{ $name }}"
        placeholder="{{ ucwords(str_replace('_', ' ', $placeholder ?? $name)) }}"
        name="{{ $name ?? null }}" {{ $attributes }}>{{ $value ?? null }}</textarea>
    <small id="form-error-{{ $name }}" class="form-error text-danger"></small>
</div>
