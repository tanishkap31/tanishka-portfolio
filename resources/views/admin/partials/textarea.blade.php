{{-- A multi-line field.
     Pass: name, label, value. Optional: required, help, rows, col, placeholder, max --}}
@php
    $id = $id ?? $name;
    $required = $required ?? false;
    $help = $help ?? null;
    $rows = $rows ?? 4;
    $placeholder = $placeholder ?? null;
    $max = $max ?? null;
@endphp
<div class="{{ $col ?? 'col-12' }}">
    <label for="{{ $id }}" class="form-label">{{ $label }}@if($required) <span class="text-danger" aria-hidden="true">*</span>@endif</label>
    <textarea class="form-control @error($name) is-invalid @enderror" id="{{ $id }}" name="{{ $name }}" rows="{{ $rows }}"@if($required) required @endif @if($placeholder) placeholder="{{ $placeholder }}" @endif @if($max) maxlength="{{ $max }}" @endif>{{ old($name, $value ?? '') }}</textarea>
    @error($name)<div class="invalid-feedback">{{ $message }}</div>@enderror
    @if($help)<div class="form-text">{{ $help }}</div>@endif
</div>
