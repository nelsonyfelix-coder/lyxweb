<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#090e17">
    <title>@yield('title', 'Dashboard').' · Portfolio admin</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-body">
    <div class="admin-shell">
        <aside class="admin-sidebar">
            <a class="brand" href="{{ route('home') }}"><span class="brand-mark">FN</span><span class="brand-copy"><strong>Portfolio admin</strong><small>LYXWEB · CONTENT STUDIO</small></span></a>
            <p class="admin-label">Workspace</p>
            <nav class="admin-nav" aria-label="Admin navigation">
                <a class="{{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}" href="{{ route('admin.dashboard') }}"><span>◫</span> Overview</a>
                <a class="{{ request()->routeIs('admin.projects.*') ? 'is-active' : '' }}" href="{{ route('admin.projects.index') }}"><span>▧</span> Projects</a>
                <a class="{{ request()->routeIs('admin.services.*') ? 'is-active' : '' }}" href="{{ route('admin.services.index') }}"><span>✳</span> Services</a>
                <a class="{{ request()->routeIs('admin.skills.*') ? 'is-active' : '' }}" href="{{ route('admin.skills.index') }}"><span>⌘</span> Skills</a>
                <a class="{{ request()->routeIs('admin.messages.*') ? 'is-active' : '' }}" href="{{ route('admin.messages.index') }}"><span>✉</span> Inbox</a>
            </nav>
            <p class="admin-label">Site</p>
            <nav class="admin-nav"><a class="{{ request()->routeIs('admin.settings.*') ? 'is-active' : '' }}" href="{{ route('admin.settings.edit') }}"><span>⚙</span> Profile & settings</a></nav>
            <div class="admin-sidebar-bottom"><nav class="admin-nav"><a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer"><span>↗</span> View live site</a></nav></div>
        </aside>
        <div class="admin-main">
            <header class="admin-topbar"><span>Signed in as</span><strong>{{ auth()->user()->name }}</strong><form action="{{ route('admin.logout') }}" method="post">@csrf<button class="button-link" type="submit">Sign out</button></form></header>
            <main class="admin-content">
                @if (session('status'))<div class="admin-flash" role="status">{{ session('status') }}</div>@endif
                @if ($errors->any())<div class="admin-errors" role="alert">Please review the form details:<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
