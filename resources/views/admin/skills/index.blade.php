@extends('admin.layouts.app')

@section('title', 'Skills')
@section('heading', 'Skills Management')

@section('actions')
    <a class="btn btn-primary" href="{{ route('admin.skills.create') }}"><i class="bi bi-plus-lg" aria-hidden="true"></i> <span>Add skill</span></a>
@endsection

@section('content')
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr><th>Skill</th><th>Category</th><th>Icon</th><th class="text-center">Order</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
                @forelse($skills as $skill)
                    <tr>
                        <td class="fw-semibold">{{ $skill->name }}</td>
                        <td>{{ $skill->category }}</td>
                        <td>
                            @if($skill->icon)
                                <i class="bi {{ $skill->icon }}" aria-hidden="true"></i> <span class="small text-secondary">{{ $skill->icon }}</span>
                            @else
                                <span class="text-secondary">None</span>
                            @endif
                        </td>
                        <td class="text-center">{{ $skill->sort_order }}</td>
                        <td class="text-end text-nowrap">
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.skills.edit', $skill) }}"><i class="bi bi-pencil-square" aria-hidden="true"></i> Edit</a>
                            <form class="d-inline" method="POST" action="{{ route('admin.skills.destroy', $skill) }}" data-confirm="Delete the skill {{ $skill->name }}?">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit"><i class="bi bi-trash" aria-hidden="true"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="empty">No skills yet. Add your first skill.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
