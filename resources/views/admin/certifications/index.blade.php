@extends('admin.layouts.app')

@section('title', 'Certifications')
@section('heading', 'Certifications Management')

@section('actions')
    <a class="btn btn-primary" href="{{ route('admin.certifications.create') }}"><i class="bi bi-plus-lg" aria-hidden="true"></i> <span>Add certification</span></a>
@endsection

@section('content')
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr><th>Certificate</th><th>Issuer</th><th>Issued</th><th>File</th><th class="text-center">Order</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
                @forelse($certifications as $certification)
                    <tr>
                        <td class="fw-semibold">{{ $certification->name }}</td>
                        <td>{{ $certification->issuer }}</td>
                        <td class="text-nowrap">{{ $certification->issued_on }}</td>
                        <td>
                            @if($certification->file_url)
                                <a href="{{ $certification->file_url }}" target="_blank" rel="noopener noreferrer"><i class="bi bi-file-earmark-check" aria-hidden="true"></i> Open</a>
                            @else
                                <span class="text-secondary">None</span>
                            @endif
                        </td>
                        <td class="text-center">{{ $certification->sort_order }}</td>
                        <td class="text-end text-nowrap">
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.certifications.edit', $certification) }}"><i class="bi bi-pencil-square" aria-hidden="true"></i> Edit</a>
                            <form class="d-inline" method="POST" action="{{ route('admin.certifications.destroy', $certification) }}" data-confirm="Delete the certificate {{ $certification->name }}?">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit"><i class="bi bi-trash" aria-hidden="true"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="empty">No certifications yet. The Certifications section stays hidden on your website until you add one.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
