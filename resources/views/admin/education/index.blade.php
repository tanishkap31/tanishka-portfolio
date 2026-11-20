@extends('admin.layouts.app')

@section('title', 'Education')
@section('heading', 'Education Management')

@section('actions')
    <a class="btn btn-primary" href="{{ route('admin.education.create') }}"><i class="bi bi-plus-lg" aria-hidden="true"></i> <span>Add education</span></a>
@endsection

@section('content')
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr><th>Degree</th><th>College</th><th>University</th><th>Result</th><th class="text-center">Order</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    <tr>
                        <td class="fw-semibold">{{ $item->degree }}</td>
                        <td>{{ $item->college }}</td>
                        <td>{{ $item->university }}</td>
                        <td class="text-nowrap">{{ $item->grade }}@if($item->duration && $item->grade), @endif{{ $item->duration }}</td>
                        <td class="text-center">{{ $item->sort_order }}</td>
                        <td class="text-end text-nowrap">
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.education.edit', $item) }}"><i class="bi bi-pencil-square" aria-hidden="true"></i> Edit</a>
                            <form class="d-inline" method="POST" action="{{ route('admin.education.destroy', $item) }}" data-confirm="Delete this education entry?">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit"><i class="bi bi-trash" aria-hidden="true"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="empty">No education yet. Add your degree.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
