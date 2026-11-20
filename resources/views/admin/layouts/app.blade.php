@php
    $unread = \App\Models\Enquiry::where('status', 'new')->count();
    $menu = [
        ['Dashboard', 'admin.dashboard', 'admin.dashboard', 'bi-speedometer2'],
        ['Profile Management', 'admin.profile.edit', 'admin.profile.*', 'bi-person-badge'],
        ['Skills Management', 'admin.skills.index', 'admin.skills.*', 'bi-code-slash'],
        ['Projects Management', 'admin.projects.index', 'admin.projects.*', 'bi-folder2-open'],
        ['Experience Management', 'admin.experiences.index', 'admin.experiences.*', 'bi-briefcase'],
        ['Education Management', 'admin.education.index', 'admin.education.*', 'bi-mortarboard'],
        ['Certifications Management', 'admin.certifications.index', 'admin.certifications.*', 'bi-patch-check'],
        ['Contact Enquiries', 'admin.enquiries.index', 'admin.enquiries.*', 'bi-inbox'],
        ['Resume Management', 'admin.resumes.index', 'admin.resumes.*', 'bi-file-earmark-pdf'],
        ['Website Settings', 'admin.settings.edit', 'admin.settings.*', 'bi-gear'],
    ];
@endphp
<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Dashboard') | Admin Panel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Familjen+Grotesk:wght@500;600;700&family=Hanken+Grotesk:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
</head>
<body>
<div class="admin-shell">
    <div class="sidebar-col">
        <aside class="sidebar offcanvas-lg offcanvas-start" tabindex="-1" id="sidebar" aria-label="Admin menu">
            <div class="sidebar-inner">
                <div class="sidebar-head">
                    <a class="sidebar-brand" href="{{ route('admin.dashboard') }}">Tanishka<small>Admin Panel</small></a>
                    <button type="button" class="btn-close btn-close-white d-lg-none" data-bs-dismiss="offcanvas" data-bs-target="#sidebar" aria-label="Close menu"></button>
                </div>

                <nav class="sidebar-nav">
                    @foreach($menu as $item)
                        <a href="{{ route($item[1]) }}" class="{{ request()->routeIs($item[2]) ? 'active' : '' }}">
                            <i class="bi {{ $item[3] }}" aria-hidden="true"></i>
                            <span>{{ $item[0] }}</span>
                            @if($item[1] === 'admin.enquiries.index' && $unread > 0)
                                <span class="badge rounded-pill">{{ $unread }}</span>
                            @endif
                        </a>
                    @endforeach
                </nav>

                <div class="sidebar-foot">Signed in as<br>{{ auth()->user()->email }}</div>
            </div>
        </aside>
    </div>

    <div class="main">
        <header class="topbar">
            <button class="btn btn-outline-secondary d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar" aria-label="Open menu">
                <i class="bi bi-list" aria-hidden="true"></i>
            </button>
            <h1>@yield('heading', 'Dashboard')</h1>
            <div class="actions">
                @yield('actions')
                <a class="btn btn-outline-secondary" href="{{ route('home') }}" target="_blank" rel="noopener"><i class="bi bi-box-arrow-up-right" aria-hidden="true"></i> <span>View site</span></a>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-box-arrow-right" aria-hidden="true"></i> <span>Log out</span></button>
                </form>
            </div>
        </header>

        <main class="content">
            @if(session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="status">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger" role="alert">Some details need fixing. The fields marked in red show what to change.</div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

<script src="{{ asset('assets/vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/admin.js') }}"></script>
</body>
</html>
