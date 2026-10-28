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
    @php
        $whatsappNumber = preg_replace('/\D+/', '', (string) $settings->phone);
        $whatsappUrl = $settings->whatsapp_url ?: ($whatsappNumber ? 'https://wa.me/'.$whatsappNumber : null);
    @endphp
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
    @if ($whatsappUrl)
        <a class="whatsapp-float" href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer" aria-label="Chat with {{ $settings->full_name }} on WhatsApp">
            <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M12 2.2a9.75 9.75 0 0 0-8.4 14.7L2.3 22l5.2-1.35A9.8 9.8 0 1 0 12 2.2Zm0 17.75a7.9 7.9 0 0 1-4.02-1.1l-.29-.17-3.08.8.82-3-.19-.3A7.95 7.95 0 1 1 12 19.95Zm4.36-5.95c-.24-.12-1.42-.7-1.64-.78-.22-.08-.38-.12-.54.12-.16.23-.62.78-.76.94-.14.16-.28.18-.52.06-.24-.12-1.02-.38-1.94-1.2-.72-.64-1.2-1.43-1.34-1.67-.14-.24-.02-.37.1-.49.1-.1.24-.27.36-.41.12-.14.16-.24.24-.4.08-.16.04-.3-.02-.42-.06-.12-.54-1.3-.74-1.78-.2-.47-.4-.4-.54-.4h-.46c-.16 0-.42.06-.64.3-.22.24-.84.82-.84 2s.86 2.32.98 2.48c.12.16 1.7 2.6 4.12 3.64.58.25 1.03.4 1.38.52.58.18 1.1.16 1.52.1.46-.07 1.42-.58 1.62-1.14.2-.56.2-1.04.14-1.14-.06-.1-.22-.16-.46-.28Z"/></svg>
            <span>WhatsApp</span>
        </a>
    @endif
</body>
</html>

