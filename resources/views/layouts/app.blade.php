<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Espace Étudiant') — CSFT</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary:        #1a3c6e;
            --primary-light:  #2a5298;
            --primary-dark:   #0f2444;
            --accent:         #e8a020;
            --sidebar-width:  240px;
            --header-h:       60px;
            --bg:             #f0f4f8;
            --bg-card:        #ffffff;
            --text-dark:      #1a2535;
            --text-muted:     #6b7a8d;
            --border:         #d8e3ed;
            --sidebar-text:   rgba(255,255,255,0.75);
            --sidebar-hover:  rgba(255,255,255,0.1);
            --sidebar-active: rgba(255,255,255,0.18);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text-dark);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ────────────────── HEADER ────────────────── */
        .app-header {
            position: fixed; top: 0; left: 0; right: 0;
            height: var(--header-h);
            background: var(--white, #fff);
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center;
            padding: 0 20px;
            z-index: 100;
            box-shadow: 0 1px 4px rgba(0,0,0,0.06);
        }

        .header-brand {
            display: flex; align-items: center; gap: 10px;
            width: var(--sidebar-width);
            flex-shrink: 0;
        }

        .header-logo-badge {
            background: var(--primary);
            color: #fff;
            font-family: 'Sora', sans-serif;
            font-size: 13px; font-weight: 700;
            padding: 5px 10px;
            border-radius: 6px;
            letter-spacing: 0.5px;
        }

        .header-brand-name {
            font-family: 'Sora', sans-serif;
            font-size: 14px; font-weight: 600;
            color: var(--primary);
            line-height: 1.2;
        }

        .header-spacer { flex: 1; }

        .header-user {
            display: flex; align-items: center; gap: 10px;
        }

        .user-info { text-align: right; }
        .user-name  { font-size: 13px; font-weight: 600; color: var(--text-dark); }
        .user-role  { font-size: 11px; color: var(--text-muted); }

        .user-avatar {
            width: 36px; height: 36px;
            background: var(--primary-light);
            color: #fff;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 700;
        }

        .btn-logout {
            margin-left: 12px;
            padding: 7px 14px;
            background: transparent;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            font-size: 12px; font-weight: 500;
            color: var(--text-muted);
            cursor: pointer;
            transition: all 0.15s;
            text-decoration: none;
        }
        .btn-logout:hover { border-color: #c0002a; color: #c0002a; background: #fff5f5; }

        /* ────────────────── SIDEBAR ────────────────── */
        .app-sidebar {
            position: fixed;
            top: var(--header-h); left: 0;
            width: var(--sidebar-width);
            bottom: 0;
            background: linear-gradient(175deg, var(--primary-dark) 0%, var(--primary) 100%);
            overflow-y: auto;
            z-index: 90;
            padding: 20px 0;
        }

        .sidebar-section-label {
            padding: 6px 20px 4px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.35);
            margin-top: 10px;
        }

        .sidebar-nav { list-style: none; }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 20px;
            font-size: 13.5px;
            color: var(--sidebar-text);
            text-decoration: none;
            transition: background 0.15s, color 0.15s;
            border-left: 3px solid transparent;
        }

        .sidebar-nav a:hover {
            background: var(--sidebar-hover);
            color: #fff;
        }

        .sidebar-nav a.active {
            background: var(--sidebar-active);
            color: #fff;
            border-left-color: var(--accent);
            font-weight: 600;
        }

        .sidebar-nav a svg {
            width: 16px; height: 16px;
            flex-shrink: 0;
            opacity: 0.8;
        }

        /* ────────────────── CONTENU PRINCIPAL ────────────────── */
        .app-main {
            margin-left: var(--sidebar-width);
            margin-top: var(--header-h);
            padding: 28px 30px;
            min-height: calc(100vh - var(--header-h));
        }

        .page-header {
            margin-bottom: 24px;
        }

        .page-header h1 {
            font-family: 'Sora', sans-serif;
            font-size: 22px; font-weight: 700;
            color: var(--text-dark);
        }

        .page-header p {
            font-size: 13px;
            color: var(--text-muted);
            margin-top: 4px;
        }

        /* ── Alerts flash ── */
        .flash-success, .flash-error {
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 13.5px;
            margin-bottom: 20px;
        }
        .flash-success { background: #f0fdf4; border: 1px solid #a8d5b5; color: #1a4d2a; }
        .flash-error   { background: #fdf0f0; border: 1px solid #f5c6cb; color: #7d1a1a; }
    </style>
    @stack('styles')
</head>
<body>

    {{-- ─── HEADER ─── --}}
    <header class="app-header">
        <div class="header-brand">
            <span class="header-logo-badge">CSFT</span>
            <span class="header-brand-name">Cité El Khadra</span>
        </div>

        <div class="header-spacer"></div>

        <div class="header-user">
            <div class="user-info">
                <div class="user-name">{{ auth()->user()->name }}</div>
                <div class="user-role">{{ auth()->user()->role_label }}</div>
            </div>
            <div class="user-avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf
                <button type="submit" class="btn-logout">Déconnexion</button>
            </form>
        </div>
    </header>

    {{-- ─── SIDEBAR (dynamique selon le rôle) ─── --}}
    <aside class="app-sidebar">
        <ul class="sidebar-nav">

            @if(auth()->user()->isStudent())
                {{-- Sidebar Étudiant --}}
                <span class="sidebar-section-label">Mon Espace</span>

                <li>
                    <a href="{{ route('student.dashboard') }}" class="{{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                        Tableau de bord
                    </a>
                </li>
                <li>
                    <a href="#" class="{{ request()->routeIs('student.notes*') ? 'active' : '' }}">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        Mes Notes
                    </a>
                </li>
                <li>
                    <a href="#" class="{{ request()->routeIs('student.schedule*') ? 'active' : '' }}">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Emploi du temps
                    </a>
                </li>
                <li>
                    <a href="#" class="{{ request()->routeIs('student.absences*') ? 'active' : '' }}">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Mes Absences
                    </a>
                </li>
                <li>
                    <a href="#" class="{{ request()->routeIs('student.demandes*') ? 'active' : '' }}">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Mes Demandes
                    </a>
                </li>
                <li>
                    <a href="#">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        Mes Cours
                    </a>
                </li>

            @elseif(auth()->user()->isTeacher())
                {{-- Sidebar Formateur --}}
                <span class="sidebar-section-label">Mon Espace</span>

                <li>
                    <a href="{{ route('teacher.dashboard') }}" class="{{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                        Tableau de bord
                    </a>
                </li>
                <li>
                    <a href="#">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Mes Groupes
                    </a>
                </li>
                <li>
                    <a href="#">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Saisie Notes
                    </a>
                </li>
                <li>
                    <a href="#">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                        Supports de cours
                    </a>
                </li>

            @elseif(auth()->user()->isAdmin())
                {{-- Sidebar Admin --}}
                <span class="sidebar-section-label">Administration</span>

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                        Tableau de bord
                    </a>
                </li>
                <li>
                    <a href="#">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        Stagiaires
                    </a>
                </li>
                <li>
                    <a href="#">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Formateurs
                    </a>
                </li>
                <li>
                    <a href="#">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Demandes docs
                    </a>
                </li>
                <li>
                    <a href="#">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        Notifications
                    </a>
                </li>
            @endif

        </ul>
    </aside>

    {{-- ─── CONTENU PRINCIPAL ─── --}}
    <main class="app-main">

        @if(session('success'))
            <div class="flash-success">✓ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="flash-error">⚠ {{ session('error') }}</div>
        @endif

        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
