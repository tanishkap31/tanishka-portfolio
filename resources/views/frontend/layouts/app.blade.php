@php
    $s = \App\Support\Site::settings();
    $p = \App\Support\Site::profile();
    $logo = \App\Support\Site::logoUrl();
    $home = route('home');
@endphp
<!doctype html>
<html lang="en" data-default-theme="{{ $s['default_theme'] }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>@yield('title', $s['site_title'] . ' | ' . $p->headline)</title>
    <meta name="description" content="@yield('description', $s['meta_description'])">
    <meta name="theme-color" content="#226192">

    {{-- Set the saved theme before the page paints, so there is no flash --}}
    <script>
        (function () {
            var d = document.documentElement;
            d.classList.add('js');
            var t = null;
            try { t = localStorage.getItem('pf-theme'); } catch (e) {}
            if (t !== 'light' && t !== 'dark') {
                t = d.getAttribute('data-default-theme');
            }
            if (t !== 'light' && t !== 'dark') {
                t = (window.matchMedia && matchMedia('(prefers-color-scheme: dark)').matches) ? 'dark' : null;
            }
            if (t) {
                d.setAttribute('data-theme', t);
                d.setAttribute('data-bs-theme', t);
            }
        })();
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Familjen+Grotesk:wght@500;600;700&family=Hanken+Grotesk:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/site.css') }}">
</head>
<body>
    <a class="skip-link" href="#main">Skip to content</a>
    <div class="progress-line" id="progress" aria-hidden="true"></div>

    <header class="site-header">
        <div class="wrap bar">
            <a class="brand" href="{{ $home }}#home">
                @if($logo)
                    <img src="{{ $logo }}" alt="">
                @endif
                <span>{{ $s['site_title'] }}</span>
            </a>

            <ul class="nav-links" id="siteNav">
                <li><a href="{{ $home }}#home" data-section="home">Home</a></li>
                <li><a href="{{ $home }}#about" data-section="about">About</a></li>
                <li><a href="{{ $home }}#skills" data-section="skills">Skills</a></li>
                <li><a href="{{ $home }}#projects" data-section="projects">Projects</a></li>
                <li><a href="{{ $home }}#experience" data-section="experience">Experience</a></li>
                <li><a href="{{ $home }}#contact" data-section="contact">Contact</a></li>
            </ul>

            <button class="icon-btn" id="themeBtn" type="button" aria-label="Switch colour theme" title="Switch colour theme">
                <i class="bi bi-circle-half" aria-hidden="true"></i>
            </button>
            <button class="icon-btn menu-btn" id="menuBtn" type="button" aria-expanded="false" aria-controls="siteNav" aria-label="Open menu">
                <i class="bi bi-list fs-4" aria-hidden="true"></i>
            </button>
        </div>
    </header>

    <main id="main">
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="wrap bar">
            <ul class="footer-links">
                @if($p->linkedin)
                    <li><a href="{{ $p->linkedin }}" target="_blank" rel="noopener noreferrer">LinkedIn</a></li>
                @endif
                @if($p->github)
                    <li><a href="{{ $p->github }}" target="_blank" rel="noopener noreferrer">GitHub</a></li>
                @endif
                @if($p->email)
                    <li><a href="mailto:{{ $p->email }}">Email</a></li>
                @endif
            </ul>
            <span>&copy; {{ date('Y') }} {{ $p->name }}@if($s['footer_text']). {{ $s['footer_text'] }}@endif</span>
        </div>
    </footer>

    <script src="{{ asset('assets/js/site.js') }}"></script>
</body>
</html>
