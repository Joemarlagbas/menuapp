<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'MenuApp') — MenuApp</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 250px;
            --topbar-height: 60px;
            --primary: #4f46e5;
            --primary-dark: #3730a3;
            --sidebar-bg: #1e1b4b;
            --sidebar-text: #c7d2fe;
            --sidebar-hover: rgba(99,102,241,0.2);
            --sidebar-active: #4f46e5;
        }

        * { font-family: 'Inter', sans-serif; }

        body {
            background: #f1f5f9;
            min-height: 100vh;
        }

        /* ── Sidebar ── */
        #sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: var(--sidebar-bg);
            position: fixed;
            top: 0; left: 0;
            z-index: 1000;
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .sidebar-brand h5 {
            color: #fff;
            font-weight: 700;
            font-size: 1.1rem;
            margin: 0;
            letter-spacing: -0.02em;
        }

        .sidebar-brand span {
            color: #818cf8;
            font-size: 0.75rem;
        }

        .sidebar-nav { padding: 1rem 0; flex: 1; }

        .nav-section-label {
            color: rgba(199,210,254,0.5);
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.75rem 1.5rem 0.25rem;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.6rem 1.5rem;
            color: var(--sidebar-text);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 0;
            transition: all 0.2s;
            position: relative;
        }

        .sidebar-link:hover {
            background: var(--sidebar-hover);
            color: #fff;
        }

        .sidebar-link.active {
            background: var(--sidebar-active);
            color: #fff;
        }

        .sidebar-link.active::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 3px;
            background: #a5b4fc;
            border-radius: 0 2px 2px 0;
        }

        .sidebar-link i { font-size: 1rem; width: 18px; text-align: center; }

        .sidebar-user {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.08);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sidebar-avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #4f46e5;
        }

        .sidebar-avatar-placeholder {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: #4f46e5;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-weight: 600; font-size: 0.85rem;
            flex-shrink: 0;
        }

        .sidebar-user-name { color: #fff; font-size: 0.8rem; font-weight: 600; }
        .sidebar-user-role { color: #818cf8; font-size: 0.7rem; }

        /* ── Main content ── */
        #main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        /* ── Topbar ── */
        .topbar {
            height: var(--topbar-height);
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            gap: 1rem;
            position: sticky;
            top: 0;
            z-index: 900;
        }

        .topbar-title {
            font-size: 1rem;
            font-weight: 600;
            color: #1e293b;
            flex: 1;
        }

        .page-content { padding: 1.5rem; }

        /* ── Cards ── */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.07), 0 1px 2px rgba(0,0,0,0.06);
        }

        .stat-card {
            border-radius: 12px;
            padding: 1.25rem;
            border: none;
            box-shadow: 0 1px 3px rgba(0,0,0,0.07);
        }

        .stat-icon {
            width: 48px; height: 48px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.25rem;
        }

        /* ── Buttons ── */
        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
        }
        .btn-primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        /* ── Table ── */
        .table th {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            border-bottom: 2px solid #e2e8f0;
            padding: 0.75rem 1rem;
        }
        .table td { padding: 0.75rem 1rem; vertical-align: middle; }

        /* ── Toast ── */
        .toast-container { z-index: 9999; }

        /* ── Auth pages ── */
        .auth-wrapper {
            min-height: 100vh;
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4338ca 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .auth-card {
            background: #fff;
            border-radius: 20px;
            padding: 2.5rem;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.25);
        }

        .auth-logo { font-size: 2rem; margin-bottom: 0.5rem; }
        .auth-title { font-size: 1.5rem; font-weight: 700; color: #1e293b; }
        .auth-subtitle { color: #64748b; font-size: 0.875rem; }

        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            padding: 0.6rem 0.875rem;
            font-size: 0.875rem;
            transition: all 0.2s;
        }
        .form-control:focus, .form-select:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79,70,229,0.12);
        }

        .form-label { font-size: 0.8rem; font-weight: 600; color: #374151; margin-bottom: 0.35rem; }

        .badge { border-radius: 6px; }

        /* ── Mobile ── */
        @media (max-width: 768px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.show { transform: translateX(0); }
            #main-content { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>

<div id="sidebar">
    <div class="sidebar-brand">
        <h5><i class="bi bi-grid-3x3-gap-fill me-2" style="color:#818cf8"></i>MenuApp</h5>
        <span>Restaurant Management</span>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Main</div>
        <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <div class="nav-section-label mt-2">Management</div>
        <a href="{{ route('users.index') }}" class="sidebar-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Users
        </a>
        <a href="{{ route('menu-items.index') }}" class="sidebar-link {{ request()->routeIs('menu-items.*') ? 'active' : '' }}">
            <i class="bi bi-journal-richtext"></i> Menu Items
        </a>

        <div class="nav-section-label mt-2">Account</div>
        <a href="{{ route('profile.show') }}" class="sidebar-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
            <i class="bi bi-person-circle"></i> My Profile
        </a>
    </nav>

    <div class="sidebar-user">
        {{-- Na-update na Sidebar Avatar Path --}}
        @if(Auth::user()->avatar)
            <img src="{{ asset('storage/avatar/' . Auth::user()->avatar) }}" alt="avatar" class="sidebar-avatar">
        @else
            <div class="sidebar-avatar-placeholder">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
        @endif
        <div class="flex-fill overflow-hidden">
            <div class="sidebar-user-name text-truncate">{{ Auth::user()->name }}</div>
            <div class="sidebar-user-role">{{ Auth::user()->is_admin ? 'Administrator' : 'User' }}</div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-sm p-0 border-0" style="color:#818cf8" title="Logout">
                <i class="bi bi-box-arrow-right fs-5"></i>
            </button>
        </form>
    </div>
</div>

<div id="main-content">
    <div class="topbar">
        <button class="btn btn-sm d-md-none" id="sidebarToggle">
            <i class="bi bi-list fs-5"></i>
        </button>
        <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
        <div class="d-flex align-items-center gap-2">
            <span class="text-muted small d-none d-sm-inline">{{ now()->format('M d, Y') }}</span>
            <a href="{{ route('profile.show') }}" class="text-decoration-none">
                {{-- Na-update na Topbar Avatar Path --}}
                @if(Auth::user()->avatar)
                    <img src="{{ asset('storage/avatar/' . Auth::user()->avatar) }}" alt="avatar" style="width:34px;height:34px;border-radius:50%;object-fit:cover;border:2px solid #e2e8f0">
                @else
                    <div style="width:34px;height:34px;border-radius:50%;background:#4f46e5;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:600;font-size:0.8rem">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @endif
            </a>
        </div>
    </div>

    <div class="page-content">
        @yield('content')
    </div>
</div>

<div class="toast-container position-fixed top-0 end-0 p-3">
    @if(session('toast_success'))
    <div class="toast align-items-center text-white border-0 show" role="alert" style="background:#059669;border-radius:10px">
        <div class="d-flex">
            <div class="toast-body d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('toast_success') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
    @endif
    @if(session('toast_error'))
    <div class="toast align-items-center text-white border-0 show" role="alert" style="background:#dc2626;border-radius:10px">
        <div class="d-flex">
            <div class="toast-body d-flex align-items-center gap-2">
                <i class="bi bi-exclamation-circle-fill"></i>
                {{ session('toast_error') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Auto-dismiss toasts
    document.querySelectorAll('.toast').forEach(el => {
        const toast = new bootstrap.Toast(el, { delay: 4000 });
        toast.show();
    });

    // Sidebar toggle mobile
    document.getElementById('sidebarToggle')?.addEventListener('click', () => {
        document.getElementById('sidebar').classList.toggle('show');
    });
</script>
@stack('scripts')
</body>
</html>