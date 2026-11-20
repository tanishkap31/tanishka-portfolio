@extends('admin.layouts.app')

@php $editing = $education->exists; @endphp

@section('title', $editing ? 'Edit education' : 'Add education')
@section('heading', $editing ? 'Edit education' : 'Add education')

@section('content')
<div class="card form-card">
    <div class="card-body">
        <form method="POST" action="{{ $editing ? route('admin.education.update', $education) : route('admin.education.store') }}">
            @csrf
            @if($editing)
                @method('PUT')
            @endif

            <div class="row g-3">
                @include('admin.partials.input', ['name' => 'degree', 'label' => 'Degree', 'value' => $education->degree, 'required' => true, 'max' => 150, 'placeholder' => 'Bachelor of Science in Computer Science'])
                @include('admin.partials.input', ['name' => 'college', 'label' => 'College', 'value' => $education->college, 'required' => true, 'max' => 200])
                @include('admin.partials.input', ['name' => 'university', 'label' => 'University', 'value' => $education->university, 'col' => 'col-md-6', 'max' => 200])
                @include('admin.partials.input', ['name' => 'duration', 'label' => 'Year or duration', 'value' => $education->duration, 'col' => 'col-md-6', 'max' => 100, 'placeholder' => '2023 - 2026'])
                @include('admin.partials.input', ['name' => 'grade', 'label' => 'Result (optional)', 'value' => $education->grade, 'col' => 'col-md-6', 'max' => 60, 'placeholder' => 'CGPA 8.51'])
                @include('admin.partials.input', ['name' => 'sort_order', 'label' => 'Order', 'value' => $education->sort_order, 'type' => 'number', 'col' => 'col-md-6', 'help' => 'Smaller numbers show first.'])
            </div>

            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-primary" type="submit">{{ $editing ? 'Save changes' : 'Add education' }}</button>
                <a class="btn btn-outline-secondary" href="{{ route('admin.education.index') }}">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
