@extends('admin.layouts.app')

@section('title', 'Experience')
@section('heading', 'Experience Management')

@section('actions')
    <a class="btn btn-primary" href="{{ route('admin.experiences.create') }}"><i class="bi bi-plus-lg" aria-hidden="true"></i> <span>Add experience</span></a>
@endsection

@section('content')
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr><th>Role</th><th>Company</th><th>Duration</th><th class="text-center">Order</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
                @forelse($experiences as $experience)
                    <tr>
                        <td class="fw-semibold">{{ $experience->role }}</td>
                        <td>{{ $experience->company }}</td>
                        <td class="text-nowrap">{{ $experience->duration }}</td>
                        <td class="text-center">{{ $experience->sort_order }}</td>
                        <td class="text-end text-nowrap">
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.experiences.edit', $experience) }}"><i class="bi bi-pencil-square" aria-hidden="true"></i> Edit</a>
                            <form class="d-inline" method="POST" action="{{ route('admin.experiences.destroy', $experience) }}" data-confirm="Delete this experience entry?">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit"><i class="bi bi-trash" aria-hidden="true"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="empty">No experience yet. Add an internship or job.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
