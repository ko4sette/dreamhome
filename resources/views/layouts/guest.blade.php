<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'DreamHome') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Serif+Display&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --bg:       #f0ebe0;
            --card:     #ffffff;
            --dark:     #1a2614;
            --dark2:    #2d3d24;
            --muted:    #7a7a6e;
            --border:   #ddd8cc;
            --input-bg: #f7f4ef;
            --shadow:   0 4px 32px rgba(26,38,20,0.10);
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            min-height: 100vh;
            color: var(--dark);
        }

        /* ── NAV ── */
        .dh-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 48px;
            background: var(--bg);
            border-bottom: 1px solid var(--border);
        }
        .dh-logo {
            font-family: 'DM Serif Display', serif;
            font-size: 22px;
            color: var(--dark);
            text-decoration: none;
            letter-spacing: -0.3px;
        }
        .dh-nav-links { display: flex; gap: 36px; }
        .dh-nav-links a {
            text-decoration: none;
            color: var(--dark);
            font-size: 14px;
            font-weight: 500;
            opacity: 0.75;
            transition: opacity .2s;
        }
        .dh-nav-links a:hover { opacity: 1; }
        .dh-nav-btns { display: flex; gap: 10px; align-items: center; }
        .dh-btn-out {
            padding: 9px 22px;
            border: 1.5px solid var(--dark);
            border-radius: 100px;
            background: transparent;
            color: var(--dark);
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: background .2s, color .2s;
            display: inline-block;
        }
        .dh-btn-out:hover { background: var(--dark); color: #fff; }
        .dh-btn-fill {
            padding: 9px 22px;
            border: none;
            border-radius: 100px;
            background: var(--dark);
            color: #fff;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: background .2s;
            display: inline-block;
        }
        .dh-btn-fill:hover { background: var(--dark2); }

        /* ── AUTH LAYOUT ── */
        .dh-auth-wrap {
            display: flex;
            min-height: calc(100vh - 62px);
            align-items: stretch;
        }
        .dh-auth-panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 40px;
        }
        .dh-auth-deco {
            width: 420px;
            background: var(--dark);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 40px;
            gap: 28px;
            position: relative;
            overflow: hidden;
        }
        .dh-auth-deco::before {
            content: '';
            position: absolute;
            width: 360px; height: 360px;
            border-radius: 50%;
            background: radial-gradient(circle, #3a5c2a 0%, transparent 70%);
            top: -80px; right: -80px;
            opacity: 0.5;
        }
        .dh-auth-deco::after {
            content: '';
            position: absolute;
            width: 280px; height: 280px;
            border-radius: 50%;
            background: radial-gradient(circle, #2d4a20 0%, transparent 70%);
            bottom: -60px; left: -60px;
            opacity: 0.4;
        }
        .dh-deco-text { position: relative; z-index: 1; text-align: center; }
        .dh-deco-text h2 {
            font-family: 'DM Serif Display', serif;
            font-size: 30px;
            color: #fff;
            line-height: 1.25;
            margin-bottom: 14px;
        }
        .dh-deco-text p {
            color: rgba(255,255,255,0.6);
            font-size: 14px;
            line-height: 1.7;
            max-width: 280px;
            margin: 0 auto;
        }
        .dh-deco-pills { display: flex; flex-wrap: wrap; gap: 8px; justify-content: center; position: relative; z-index: 1; }
        .dh-deco-pill {
            padding: 7px 16px;
            border: 1px solid rgba(255,255,255,0.25);
            border-radius: 100px;
            color: rgba(255,255,255,0.8);
            font-size: 12px;
            font-weight: 500;
        }
        .dh-deco-stat { display: flex; gap: 28px; position: relative; z-index: 1; }
        .dh-stat-item { text-align: center; }
        .dh-stat-item .num { font-family: 'DM Serif Display', serif; font-size: 28px; color: #fff; }
        .dh-stat-item .lbl { font-size: 11px; color: rgba(255,255,255,0.5); margin-top: 2px; }

        /* ── CARD ── */
        .dh-card {
            background: var(--card);
            border-radius: 20px;
            padding: 44px 40px;
            width: 100%;
            max-width: 440px;
            box-shadow: var(--shadow);
        }
        .dh-card-head { margin-bottom: 28px; }
        .dh-card-head h1 {
            font-family: 'DM Serif Display', serif;
            font-size: 28px;
            color: var(--dark);
            margin-bottom: 6px;
        }
        .dh-card-head p { font-size: 13.5px; color: var(--muted); line-height: 1.5; }

        /* ── FORM ── */
        .dh-fg { margin-bottom: 14px; }
        .dh-fg label {
            display: block;
            font-size: 12.5px;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 6px;
        }
        .dh-fg input, .dh-fg select, .dh-fg textarea {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13.5px;
            background: var(--input-bg);
            color: var(--dark);
            outline: none;
            transition: border-color .2s, background .2s;
            appearance: none;
        }
        .dh-fg input:focus, .dh-fg select:focus, .dh-fg textarea:focus {
            border-color: var(--dark);
            background: #fff;
        }
        .dh-fg textarea { resize: none; }
        .dh-row2 { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }

        .dh-btn-main {
            width: 100%;
            padding: 13px;
            background: var(--dark);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 6px;
            transition: background .2s, transform .1s;
            text-align: center;
        }
        .dh-btn-main:hover { background: var(--dark2); }
        .dh-btn-main:active { transform: scale(0.98); }

        .dh-btn-sec {
            width: 100%;
            padding: 13px;
            background: transparent;
            color: var(--dark);
            border: 1.5px solid var(--border);
            border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 8px;
            transition: border-color .2s, background .2s;
        }
        .dh-btn-sec:hover { border-color: var(--dark); background: var(--input-bg); }

        .dh-switch { text-align: center; margin-top: 18px; font-size: 13px; color: var(--muted); }
        .dh-switch a {
            color: var(--dark);
            font-weight: 700;
            text-decoration: none;
            border-bottom: 1.5px solid var(--dark);
            padding-bottom: 1px;
        }

        /* ── STEP BAR ── */
        .dh-steps-bar { display: flex; gap: 6px; margin-bottom: 8px; }
        .dh-step-seg { flex: 1; height: 3px; border-radius: 2px; background: var(--border); transition: background .35s; }
        .dh-step-seg.done { background: var(--dark); }
        .dh-step-meta { font-size: 12px; color: var(--muted); margin-bottom: 22px; }
        .dh-step-meta b { color: var(--dark); }

        /* ── FORM SECTIONS ── */
        .dh-fsec { display: none; }
        .dh-fsec.active { display: block; }

        /* ── DIVIDER ── */
        .dh-divider { display: flex; align-items: center; gap: 12px; margin: 18px 0; color: var(--muted); font-size: 12px; }
        .dh-divider::before, .dh-divider::after { content: ''; flex: 1; height: 1px; background: var(--border); }

        /* ── ALERTS ── */
        .dh-alert { padding: 12px 16px; border-radius: 10px; font-size: 13px; margin-bottom: 16px; }
        .dh-alert-error { background: #fdecea; border: 1px solid #f5c2c7; color: #842029; }
        .dh-alert-success { background: #eaf4e8; border: 1px solid #b8ddb4; color: #3a6b35; }
        .dh-alert ul { padding-left: 18px; }

        /* ── REMEMBER ROW ── */
        .dh-remember-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px; }
        .dh-remember-row label { display: flex; align-items: center; gap: 8px; font-size: 13px; color: var(--muted); cursor: pointer; }
        .dh-remember-row a { font-size: 13px; color: var(--muted); text-decoration: underline; }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            .dh-auth-deco { display: none; }
            .dh-nav { padding: 14px 20px; }
            .dh-nav-links { display: none; }
            .dh-card { padding: 32px 24px; }
            .dh-auth-panel { padding: 30px 16px; align-items: flex-start; padding-top: 40px; }
        }
    </style>
</head>
<body>

    {{-- NAV --}}
    <nav class="dh-nav">
        <a href="{{ route('home') }}" class="dh-logo">DreamHome</a>
        <div class="dh-nav-links">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('properties.index') }}">Properties</a>
        </div>
        <div class="dh-nav-btns">
            <a href="{{ route('login') }}" class="dh-btn-out">Login</a>
            <a href="{{ route('register') }}" class="dh-btn-fill">Register</a>
        </div>
    </nav>

    {{-- PAGE CONTENT --}}
    {{ $slot }}

</body>
</html>