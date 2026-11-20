@extends('admin.layouts.app')

@section('title', 'Enquiry from ' . $enquiry->name)
@section('heading', 'Enquiry')

@section('actions')
    <a class="btn btn-outline-secondary" href="{{ route('admin.enquiries.index') }}"><i class="bi bi-arrow-left" aria-hidden="true"></i> <span>All enquiries</span></a>
@endsection

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h2 class="h4 mb-3">{{ $enquiry->subject }}</h2>

                <dl class="meta-grid mb-4">
                    <dt>From</dt><dd>{{ $enquiry->name }}</dd>
                    <dt>Email</dt><dd><a href="mailto:{{ $enquiry->email }}">{{ $enquiry->email }}</a></dd>
                    <dt>Received</dt><dd>{{ $enquiry->created_at->format('d M Y, h:i A') }}</dd>
                    @if($enquiry->ip_address)
                        <dt>IP address</dt><dd>{{ $enquiry->ip_address }}</dd>
                    @endif
                </dl>

                <div class="message-box">{{ $enquiry->message }}</div>

                <div class="d-flex flex-wrap gap-2 mt-4">
                    <a class="btn btn-primary" href="mailto:{{ $enquiry->email }}?subject={{ rawurlencode('Re: ' . $enquiry->subject) }}"><i class="bi bi-reply" aria-hidden="true"></i> Reply by email</a>
                    <form method="POST" action="{{ route('admin.enquiries.destroy', $enquiry) }}" data-confirm="Delete this enquiry from {{ $enquiry->name }}?">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger" type="submit"><i class="bi bi-trash" aria-hidden="true"></i> Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-title-row"><h2>Follow up</h2></div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.enquiries.update', $enquiry) }}" class="d-grid gap-3">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="form-label" for="status">Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                            @foreach($statuses as $key => $label)
                                <option value="{{ $key }}" {{ old('status', $enquiry->status) === $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div>
                        <label class="form-label" for="notes">Private notes</label>
                        <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="5" maxlength="2000" placeholder="Budget, deadline, what you replied...">{{ old('notes', $enquiry->notes) }}</textarea>
                        @error('notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <div class="form-text">Only you can see these notes.</div>
                    </div>

                    <button class="btn btn-primary" type="submit">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
