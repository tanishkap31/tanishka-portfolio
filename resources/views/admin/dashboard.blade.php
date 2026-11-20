@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('heading', 'Dashboard Overview')

@section('content')
<div class="row g-3 mb-4">
    <div class="col-6 col-xl-3">
        <div class="card stat"><span class="label">Total Projects</span><span class="num">{{ sprintf('%02d', $totalProjects) }}</span></div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="card stat"><span class="label">Total Enquiries</span><span class="num">{{ sprintf('%02d', $totalEnquiries) }}</span></div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="card stat"><span class="label">Total Skills</span><span class="num">{{ sprintf('%02d', $totalSkills) }}</span></div>
    </div>
    <div class="col-6 col-xl-3">
        <a class="card stat {{ $unread > 0 ? 'accent' : '' }} text-decoration-none" href="{{ route('admin.enquiries.index', ['status' => 'new']) }}">
            <span class="label">Unread Messages</span><span class="num">{{ sprintf('%02d', $unread) }}</span>
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-title-row">
                <h2>Latest enquiries</h2>
                <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.enquiries.index') }}">See all</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr><th>From</th><th>Subject</th><th>Received</th><th>Status</th></tr>
                    </thead>
                    <tbody>
                        @forelse($latest as $enquiry)
                            <tr class="{{ $enquiry->status === 'new' ? 'unread' : '' }}">
                                <td>
                                    <a class="text-decoration-none" href="{{ route('admin.enquiries.show', $enquiry) }}">{{ $enquiry->name }}</a>
                                    <div class="small text-secondary">{{ $enquiry->email }}</div>
                                </td>
                                <td>{{ \Illuminate\Support\Str::limit($enquiry->subject, 40) }}</td>
                                <td class="text-nowrap">{{ $enquiry->created_at->format('d M Y, h:i A') }}</td>
                                <td><span class="badge {{ $enquiry->status_badge }}">{{ $enquiry->status_label }}</span></td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="empty">No enquiries yet. Messages from your contact form appear here.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="card mb-4">
            <div class="card-title-row"><h2>Content overview</h2></div>
            <ul class="overview">
                @foreach($extra as $label => $count)
                    <li><span>{{ $label }}</span><strong>{{ $count }}</strong></li>
                @endforeach
            </ul>
        </div>

        <div class="card">
            <div class="card-title-row"><h2>Live resume</h2></div>
            <div class="p-3">
                @if($activeResume)
                    <p class="mb-2"><i class="bi bi-file-earmark-pdf" aria-hidden="true"></i> {{ $activeResume->original_name }}</p>
                    <p class="small text-secondary mb-3">Visitors download this file from your portfolio.</p>
                @else
                    <p class="text-secondary">No resume is live yet. The Download Resume button stays hidden until you upload one.</p>
                @endif
                <a class="btn btn-primary btn-sm" href="{{ route('admin.resumes.index') }}">Manage resume</a>
            </div>
        </div>
    </div>
</div>
@endsection
