<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="theme-color" content="#090e17">
    <title>Admin sign in · {{ config('app.name') }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-body">
    <main class="admin-login-wrap">
        <section class="admin-login-card">
            <a class="brand" href="{{ route('home') }}"><span class="brand-mark">FN</span><span class="brand-copy"><strong>Portfolio admin</strong><small>LYXWEB · CONTENT STUDIO</small></span></a>
            <p class="overline">Welcome back</p><h1>Sign in to manage<br>your portfolio.</h1><p>Use your administrator account to continue.</p>
            @if ($errors->any())<div class="admin-errors" role="alert">{{ $errors->first() }}</div>@endif
            <form class="login-form" action="{{ route('admin.login.store') }}" method="post">
                @csrf
                <label>Email address<input type="email" name="email" value="{{ old('email') }}" required autocomplete="username" autofocus></label>
                <label>Password<input type="password" name="password" required autocomplete="current-password"></label>
                <label class="remember-row"><input type="checkbox" name="remember" value="1"><span>Keep me signed in</span></label>
                <button class="button button-primary" type="submit">Sign in <span aria-hidden="true">↗</span></button>
            </form>
        </section>
    </main>
</body>
</html>
