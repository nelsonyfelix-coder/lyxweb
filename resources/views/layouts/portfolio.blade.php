<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#080d18">
    <meta name="description" content="{{ $settings->meta_description }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', $settings->full_name.' — '.$settings->role)">
    <meta property="og:description" content="{{ $settings->meta_description }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <title>@yield('title', $settings->full_name.' — '.$settings->role)</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="site-shell">
    <a class="skip-link" href="#main">Skip to content</a>
    <div class="ambient ambient-one" aria-hidden="true"></div>
    <div class="ambient ambient-two" aria-hidden="true"></div>
    <header class="site-header">
        <div class="wrap nav-wrap">
            <a class="brand" href="{{ route('home') }}" aria-label="{{ $settings->full_name }} home">
                <span class="brand-mark">FN</span>
                <span class="brand-copy"><strong>{{ $settings->full_name }}</strong><small>{{ $settings->brand_name }}</small></span>
            </a>
            <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="site-navigation" aria-label="Open navigation"><span></span><span></span></button>
            <nav class="site-nav" id="site-navigation" aria-label="Main navigation">
                <a href="{{ route('home') }}#services">Services</a>
                <a href="{{ route('home') }}#work">Selected work</a>
                <a href="{{ route('home') }}#about">About</a>
                <a class="nav-cta" href="{{ route('home') }}#contact">Let’s talk <span aria-hidden="true">↗</span></a>
            </nav>
        </div>
    </header>
    <main id="main">
        @yield('content')
    </main>
    <footer class="site-footer">
        <div class="wrap footer-row">
            <a class="brand brand-small" href="{{ route('home') }}"><span class="brand-mark">FN</span><span class="brand-copy"><strong>{{ $settings->full_name }}</strong><small>Building digital experiences that matter.</small></span></a>
            <p>© {{ now()->year }} {{ $settings->full_name }}. Made with care in {{ $settings->location ?: 'Tanzania' }}.</p>
            <a class="top-link" href="#main">Back to top ↑</a>
        </div>
    </footer>
</body>
</html>
