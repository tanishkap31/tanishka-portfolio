@extends('admin.layouts.app')

@php $editing = $skill->exists; @endphp

@section('title', $editing ? 'Edit skill' : 'Add skill')
@section('heading', $editing ? 'Edit skill' : 'Add skill')

@section('content')
<div class="card form-card">
    <div class="card-body">
        <form method="POST" action="{{ $editing ? route('admin.skills.update', $skill) : route('admin.skills.store') }}">
            @csrf
            @if($editing)
                @method('PUT')
            @endif

            <div class="row g-3">
                @include('admin.partials.input', ['name' => 'name', 'label' => 'Skill name', 'value' => $skill->name, 'required' => true, 'col' => 'col-md-6', 'max' => 80, 'placeholder' => 'Laravel'])
                @include('admin.partials.input', ['name' => 'category', 'label' => 'Category', 'value' => $skill->category, 'required' => true, 'col' => 'col-md-6', 'max' => 60, 'list' => 'categoryList', 'help' => 'Pick one or type a new one, for example Back end.'])
                @include('admin.partials.input', ['name' => 'icon', 'label' => 'Icon (optional)', 'value' => $skill->icon, 'col' => 'col-md-6', 'max' => 60, 'placeholder' => 'bi-code-slash', 'help' => 'A Bootstrap Icons class name. Leave empty for no icon.'])
                @include('admin.partials.input', ['name' => 'sort_order', 'label' => 'Order', 'value' => $skill->sort_order, 'type' => 'number', 'col' => 'col-md-6', 'help' => 'Smaller numbers show first.'])
            </div>

            <datalist id="categoryList">
                @foreach($categories as $category)
                    <option value="{{ $category }}">
                @endforeach
            </datalist>

            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-primary" type="submit">{{ $editing ? 'Save changes' : 'Add skill' }}</button>
                <a class="btn btn-outline-secondary" href="{{ route('admin.skills.index') }}">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
