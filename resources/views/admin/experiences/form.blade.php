@extends('admin.layouts.app')

@php $editing = $experience->exists; @endphp

@section('title', $editing ? 'Edit experience' : 'Add experience')
@section('heading', $editing ? 'Edit experience' : 'Add experience')

@section('content')
<div class="card form-card">
    <div class="card-body">
        <form method="POST" action="{{ $editing ? route('admin.experiences.update', $experience) : route('admin.experiences.store') }}">
            @csrf
            @if($editing)
                @method('PUT')
            @endif

            <div class="row g-3">
                @include('admin.partials.input', ['name' => 'role', 'label' => 'Role', 'value' => $experience->role, 'required' => true, 'col' => 'col-md-6', 'max' => 150, 'placeholder' => 'Java Development Intern'])
                @include('admin.partials.input', ['name' => 'company', 'label' => 'Company', 'value' => $experience->company, 'required' => true, 'col' => 'col-md-6', 'max' => 150])
                @include('admin.partials.input', ['name' => 'duration', 'label' => 'Duration', 'value' => $experience->duration, 'required' => true, 'col' => 'col-md-6', 'max' => 100, 'placeholder' => 'November 2025 - January 2026'])
                @include('admin.partials.input', ['name' => 'location', 'label' => 'Location (optional)', 'value' => $experience->location, 'col' => 'col-md-6', 'max' => 150])
                @include('admin.partials.textarea', ['name' => 'description', 'label' => 'Responsibilities', 'value' => $experience->description, 'rows' => 6, 'help' => 'One bullet point per line.'])
                @include('admin.partials.input', ['name' => 'sort_order', 'label' => 'Order', 'value' => $experience->sort_order, 'type' => 'number', 'col' => 'col-md-6', 'help' => 'Smaller numbers show first.'])
            </div>

            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-primary" type="submit">{{ $editing ? 'Save changes' : 'Add experience' }}</button>
                <a class="btn btn-outline-secondary" href="{{ route('admin.experiences.index') }}">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
