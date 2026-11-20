@extends('admin.layouts.app')

@section('title', 'Enquiries')
@section('heading', 'Contact Enquiries')

@section('content')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3">
    <div class="filters" aria-label="Filter by status">
        <a href="{{ route('admin.enquiries.index', ['q' => $search ?: null]) }}" class="{{ $status === '' ? 'on' : '' }}">All</a>
        @foreach($statuses as $key => $label)
            <a href="{{ route('admin.enquiries.index', ['status' => $key, 'q' => $search ?: null]) }}" class="{{ $status === $key ? 'on' : '' }}">{{ $label }}</a>
        @endforeach
    </div>

    <form class="d-flex gap-2" method="GET" action="{{ route('admin.enquiries.index') }}" role="search">
        @if($status !== '')
            <input type="hidden" name="status" value="{{ $status }}">
        @endif
        <label class="visually-hidden" for="q">Search enquiries</label>
        <input class="form-control" id="q" name="q" type="search" value="{{ $search }}" placeholder="Search name, email or message">
        <button class="btn btn-primary" type="submit"><i class="bi bi-search" aria-hidden="true"></i><span class="visually-hidden">Search</span></button>
    </form>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr><th>From</th><th>Subject</th><th>Received</th><th>Status</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
                @forelse($enquiries as $enquiry)
                    <tr class="{{ $enquiry->status === 'new' ? 'unread' : '' }}">
                        <td>
                            <a class="text-decoration-none" href="{{ route('admin.enquiries.show', $enquiry) }}">{{ $enquiry->name }}</a>
                            <div class="small text-secondary fw-normal">{{ $enquiry->email }}</div>
                        </td>
                        <td>{{ \Illuminate\Support\Str::limit($enquiry->subject, 50) }}</td>
                        <td class="text-nowrap">{{ $enquiry->created_at->format('d M Y, h:i A') }}</td>
                        <td><span class="badge {{ $enquiry->status_badge }}">{{ $enquiry->status_label }}</span></td>
                        <td class="text-end text-nowrap">
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.enquiries.show', $enquiry) }}"><i class="bi bi-eye" aria-hidden="true"></i> Open</a>
                            <form class="d-inline" method="POST" action="{{ route('admin.enquiries.destroy', $enquiry) }}" data-confirm="Delete this enquiry from {{ $enquiry->name }}?">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit"><i class="bi bi-trash" aria-hidden="true"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="empty">No enquiries found. Messages sent from the Contact form on your website appear here.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $enquiries->links('pagination::bootstrap-5') }}
</div>
@endsection
