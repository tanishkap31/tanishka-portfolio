@extends('admin.layouts.app')

@section('title', 'Resume')
@section('heading', 'Resume Management')

@section('content')
<div class="row g-4">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-title-row"><h2>Upload a resume</h2></div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data" action="{{ route('admin.resumes.store') }}" class="d-grid gap-3">
                    @csrf

                    <div>
                        <label class="form-label" for="file">PDF file</label>
                        <input class="form-control @error('file') is-invalid @enderror" id="file" name="file" type="file" accept="application/pdf" required>
                        @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <div class="form-text">PDF only, up to 5 MB.</div>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="make_active" id="make_active" value="1" checked>
                        <label class="form-check-label" for="make_active">Make this the resume visitors download</label>
                    </div>

                    <button class="btn btn-primary" type="submit"><i class="bi bi-upload" aria-hidden="true"></i> Upload</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr><th>File</th><th>Uploaded</th><th>Status</th><th class="text-end">Actions</th></tr>
                    </thead>
                    <tbody>
                        @forelse($resumes as $resume)
                            <tr>
                                <td class="fw-semibold"><i class="bi bi-file-earmark-pdf" aria-hidden="true"></i> {{ $resume->original_name }}</td>
                                <td class="text-nowrap">{{ $resume->created_at->format('d M Y') }}</td>
                                <td>
                                    @if($resume->is_active)
                                        <span class="badge text-bg-success">Live on website</span>
                                    @else
                                        <span class="badge text-bg-secondary">Not live</span>
                                    @endif
                                </td>
                                <td class="text-end text-nowrap">
                                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.resumes.download', $resume) }}"><i class="bi bi-download" aria-hidden="true"></i> Download</a>
                                    @unless($resume->is_active)
                                        <form class="d-inline" method="POST" action="{{ route('admin.resumes.activate', $resume) }}">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-sm btn-outline-primary" type="submit">Make live</button>
                                        </form>
                                    @endunless
                                    <form class="d-inline" method="POST" action="{{ route('admin.resumes.destroy', $resume) }}" data-confirm="Delete {{ $resume->original_name }}?">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" type="submit"><i class="bi bi-trash" aria-hidden="true"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="empty">No resume yet. Upload a PDF and the Download Resume button appears on your website.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
