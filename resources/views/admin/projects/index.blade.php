@extends('admin.layouts.app')

@section('title', 'Projects')
@section('heading', 'Projects Management')

@section('actions')
    <a class="btn btn-primary" href="{{ route('admin.projects.create') }}"><i class="bi bi-plus-lg" aria-hidden="true"></i> <span>Add project</span></a>
@endsection

@section('content')
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr><th>Project</th><th>Tools</th><th>Status</th><th class="text-center">Order</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                    <tr>
                        <td>
                            <div class="fw-semibold">{{ $project->title }}</div>
                            @if($project->tagline)
                                <div class="small text-secondary">{{ \Illuminate\Support\Str::limit($project->tagline, 60) }}</div>
                            @endif
                        </td>
                        <td class="small">{{ \Illuminate\Support\Str::limit((string) $project->tools, 50) }}</td>
                        <td>
                            @if($project->is_published)
                                <span class="badge text-bg-success">Published</span>
                            @else
                                <span class="badge text-bg-secondary">Hidden</span>
                            @endif
                        </td>
                        <td class="text-center">{{ $project->sort_order }}</td>
                        <td class="text-end text-nowrap">
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('projects.show', $project) }}" target="_blank" rel="noopener"><i class="bi bi-eye" aria-hidden="true"></i> View</a>
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.projects.edit', $project) }}"><i class="bi bi-pencil-square" aria-hidden="true"></i> Edit</a>
                            <form class="d-inline" method="POST" action="{{ route('admin.projects.destroy', $project) }}" data-confirm="Delete the project {{ $project->title }}?">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit"><i class="bi bi-trash" aria-hidden="true"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="empty">No projects yet. Add your first project.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
