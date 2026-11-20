{{-- A file upload with the current file and a "remove" tick box.
     Pass: name, label. Optional: current (url of the saved file), remove (name of the remove checkbox),
     isImage (true shows a picture), accept, help, col --}}
@php
    $id = $id ?? $name;
    $current = $current ?? null;
    $remove = $remove ?? null;
    $isImage = $isImage ?? true;
    $accept = $accept ?? 'image/png,image/jpeg,image/webp';
    $help = $help ?? null;
@endphp
<div class="{{ $col ?? 'col-12' }}">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>

    @if($current)
        <div class="mb-2">
            @if($isImage)
                <img class="preview-img" src="{{ $current }}" alt="Current {{ strtolower($label) }}">
            @else
                <a href="{{ $current }}" target="_blank" rel="noopener noreferrer"><i class="bi bi-file-earmark-check" aria-hidden="true"></i> Open current file</a>
            @endif
        </div>
    @endif
    @if($isImage)
        <img class="preview-img mb-2" id="{{ $id }}_preview" alt="New picture preview" hidden>
    @endif

    <input class="form-control @error($name) is-invalid @enderror" id="{{ $id }}" name="{{ $name }}" type="file" accept="{{ $accept }}" @if($isImage) data-preview="{{ $id }}_preview" @endif>
    @error($name)<div class="invalid-feedback">{{ $message }}</div>@enderror
    @if($help)<div class="form-text">{{ $help }}</div>@endif

    @if($current && $remove)
        <div class="form-check mt-2">
            <input class="form-check-input" type="checkbox" name="{{ $remove }}" id="{{ $remove }}" value="1">
            <label class="form-check-label" for="{{ $remove }}">Remove the current file</label>
        </div>
    @endif
</div>
