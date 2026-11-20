{{-- One text/email/url/number field.
     Pass: name, label, value. Optional: type, required, help, placeholder, list, col, max, id --}}
@php
    $id = $id ?? $name;
    $type = $type ?? 'text';
    $required = $required ?? false;
    $help = $help ?? null;
    $placeholder = $placeholder ?? null;
    $list = $list ?? null;
    $max = $max ?? null;
@endphp
<div class="{{ $col ?? 'col-12' }}">
    <label for="{{ $id }}" class="form-label">{{ $label }}@if($required) <span class="text-danger" aria-hidden="true">*</span>@endif</label>
    <input class="form-control @error($name) is-invalid @enderror" id="{{ $id }}" name="{{ $name }}" type="{{ $type }}" value="{{ old($name, $value ?? '') }}"@if($required) required @endif @if($placeholder) placeholder="{{ $placeholder }}" @endif @if($list) list="{{ $list }}" @endif @if($max) maxlength="{{ $max }}" @endif>
    @error($name)<div class="invalid-feedback">{{ $message }}</div>@enderror
    @if($help)<div class="form-text">{{ $help }}</div>@endif
</div>
