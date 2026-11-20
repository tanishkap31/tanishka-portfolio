@extends('admin.layouts.app')

@php $editing = $certification->exists; @endphp

@section('title', $editing ? 'Edit certification' : 'Add certification')
@section('heading', $editing ? 'Edit certification' : 'Add certification')

@section('content')
<div class="card form-card">
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="{{ $editing ? route('admin.certifications.update', $certification) : route('admin.certifications.store') }}">
            @csrf
            @if($editing)
                @method('PUT')
            @endif

            <div class="row g-3">
                @include('admin.partials.input', ['name' => 'name', 'label' => 'Certificate name', 'value' => $certification->name, 'required' => true, 'max' => 200])
                @include('admin.partials.input', ['name' => 'issuer', 'label' => 'Issued by', 'value' => $certification->issuer, 'required' => true, 'col' => 'col-md-6', 'max' => 200, 'placeholder' => 'Coursera, Google, IT Vedant'])
                @include('admin.partials.input', ['name' => 'issued_on', 'label' => 'Issued on', 'value' => $certification->issued_on, 'col' => 'col-md-6', 'max' => 60, 'placeholder' => 'March 2026'])
                @include('admin.partials.input', ['name' => 'credential_url', 'label' => 'Verification link (optional)', 'value' => $certification->credential_url, 'type' => 'url', 'col' => 'col-md-6'])
                @include('admin.partials.input', ['name' => 'sort_order', 'label' => 'Order', 'value' => $certification->sort_order, 'type' => 'number', 'col' => 'col-md-6', 'help' => 'Smaller numbers show first.'])
                @include('admin.partials.upload', ['name' => 'file', 'label' => 'Certificate file', 'current' => $certification->file_url, 'remove' => 'remove_file', 'isImage' => false, 'accept' => 'application/pdf,image/png,image/jpeg,image/webp', 'help' => 'PDF, JPG, PNG or WebP, up to 5 MB.'])
            </div>

            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-primary" type="submit">{{ $editing ? 'Save changes' : 'Add certification' }}</button>
                <a class="btn btn-outline-secondary" href="{{ route('admin.certifications.index') }}">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
