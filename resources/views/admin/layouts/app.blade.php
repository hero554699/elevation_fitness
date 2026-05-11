<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin — Elevation Fitness Gym')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Barlow+Condensed:wght@600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --red: #E8001D;
            --navy: #1A1A2E;
            --offwhite: #F5F5F5;
            --orange: #FF6B35;
            --green: #2ECC71;
            --text: #2D2D2D;
            --border: #E2E2E2;
            --white: #FFFFFF;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--offwhite);
            color: var(--text);
        }

        .condensed {
            font-family: 'Barlow Condensed', sans-serif;
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: var(--navy);
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            z-index: 50;
        }

        .sidebar-logo {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .sidebar-nav {
            padding: 16px 12px;
            flex: 1;
        }

        .nav-section-label {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.35);
            padding: 12px 8px 6px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 8px;
            color: rgba(255, 255, 255, 0.65);
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.15s;
            margin-bottom: 2px;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #fff;
        }

        .nav-item.active {
            background: var(--red);
            color: #fff;
        }

        .nav-item .icon {
            width: 18px;
            text-align: center;
            font-size: 15px;
        }

        .main-content {
            margin-left: 260px;
            min-height: 100vh;
        }

        .topbar {
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 0 32px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 40;
        }

        .page-content {
            padding: 32px;
        }

        .card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 12px;
        }

        .stat-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 24px;
        }

        .btn-primary {
            background: var(--red);
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: opacity 0.15s;
        }

        .btn-primary:hover {
            opacity: 0.88;
        }

        .btn-secondary {
            background: var(--offwhite);
            color: var(--text);
            border: 1px solid var(--border);
            padding: 10px 20px;
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.15s;
        }

        .btn-secondary:hover {
            border-color: #ccc;
        }

        .btn-danger {
            background: #FEF2F2;
            color: var(--red);
            border: 1px solid #FECACA;
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.15s;
        }

        .btn-danger:hover {
            background: var(--red);
            color: #fff;
        }

        .btn-edit {
            background: #EFF6FF;
            color: #2563EB;
            border: 1px solid #BFDBFE;
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: all 0.15s;
        }

        .btn-edit:hover {
            background: #2563EB;
            color: #fff;
        }

        .btn-view {
            background: #F0FDF4;
            color: #16A34A;
            border: 1px solid #BBF7D0;
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: all 0.15s;
        }

        .btn-view:hover {
            background: #16A34A;
            color: #fff;
        }

        .badge-active {
            background: #DCFCE7;
            color: #15803D;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-pending {
            background: #FEF9C3;
            color: #854D0E;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-expired {
            background: #FEE2E2;
            color: #991B1B;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-inactive {
            background: #F3F4F6;
            color: #6B7280;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-paid {
            background: #DCFCE7;
            color: #15803D;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-unpaid {
            background: #FFEDD5;
            color: #C2410C;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .form-input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            color: var(--text);
            background: #fff;
            transition: border-color 0.15s;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--red);
            box-shadow: 0 0 0 3px rgba(232, 0, 29, 0.08);
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead tr {
            background: #F9FAFB;
            border-bottom: 1px solid var(--border);
        }

        th {
            text-align: left;
            padding: 12px 16px;
            font-size: 12px;
            font-weight: 600;
            color: #6B7280;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.1s;
        }

        tbody tr:hover {
            background: #FAFAFA;
        }

        td {
            padding: 14px 16px;
            font-size: 14px;
            vertical-align: middle;
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        .alert-success {
            background: #F0FDF4;
            border: 1px solid #BBF7D0;
            color: #15803D;
            padding: 14px 16px;
            border-radius: 8px;
            font-size: 14px;
        }

        .alert-error {
            background: #FEF2F2;
            border: 1px solid #FECACA;
            color: #991B1B;
            padding: 14px 16px;
            border-radius: 8px;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <div class="sidebar-logo">
            <a href="{{ route('admin.dashboard') }}" style="text-decoration:none;">
                <div style="display:flex; align-items:center; gap:10px;">
                    <div style="width:32px;height:32px;background:var(--red);clip-path:polygon(50% 0%,100% 25%,100% 75%,50% 100%,0% 75%,0% 25%);flex-shrink:0;"></div>
                    <div>
                        <div class="condensed" style="color:#fff;font-size:18px;letter-spacing:0.08em;line-height:1;">ELEVATION</div>
                        <div style="color:rgba(255,255,255,0.4);font-size:10px;letter-spacing:0.1em;">FITNESS GYM · ADMIN</div>
                    </div>
                </div>
            </a>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">Overview</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active':'' }}">
                <span class="icon">📊</span> Dashboard
            </a>

            <div class="nav-section-label">Management</div>
            <a href="{{ route('admin.members.index') }}" class="nav-item {{ request()->routeIs('admin.members.*') ? 'active':'' }}">
                <span class="icon">👥</span> Members
            </a>

            <a href="{{ route('admin.attendance.index') }}" class="nav-item {{ request()->routeIs('admin.attendance.*') ? 'active':'' }}">
                <span class="icon">📋</span> Attendance
            </a>

            @if(Auth::user()->isBranchAdmin())
            <a href="{{ route('admin.workers.index') }}" class="nav-item {{ request()->routeIs('admin.workers.*') ? 'active':'' }}">
                <span class="icon">🧑‍💼</span> Workers
            </a>
            <a href="{{ route('admin.coaches.index') }}" class="nav-item {{ request()->routeIs('admin.coaches.*') ? 'active':'' }}">
                <span class="icon">🏋️</span> Coaches
            </a>
            @endif

            @if(Auth::user()->isSuperAdmin())
            <a href="{{ route('admin.workers.index') }}" class="nav-item {{ request()->routeIs('admin.workers.*') ? 'active':'' }}">
                <span class="icon">🧑‍💼</span> Workers
            </a>
            <a href="{{ route('admin.coaches.index') }}" class="nav-item {{ request()->routeIs('admin.coaches.*') ? 'active':'' }}">
                <span class="icon">🏋️</span> Coaches
            </a>
            @endif

            <div class="nav-section-label">Locations</div>
            <a href="{{ route('admin.branches.index') }}" class="nav-item {{ request()->routeIs('admin.branches.*') ? 'active':'' }}">
                <span class="icon">📍</span> Branches
            </a>

            <div class="nav-section-label">Site</div>
            <a href="{{ route('home') }}" class="nav-item" target="_blank">
                <span class="icon">🌐</span> View Public Site
            </a>
        </nav>

        <div style="padding:16px 20px; border-top:1px solid rgba(255,255,255,0.08);">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" style="width:100%;background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.1);color:rgba(255,255,255,0.65);padding:10px;border-radius:8px;font-family:'Inter',sans-serif;font-weight:600;font-size:14px;cursor:pointer;transition:all 0.15s;"
                    onmouseover="this.style.background='rgba(232,0,29,0.2)';this.style.color='#fff';"
                    onmouseout="this.style.background='rgba(255,255,255,0.06)';this.style.color='rgba(255,255,255,0.65)';">
                    🚪 Log Out
                </button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <div class="topbar">
            <div>
                <h1 style="font-size:18px;font-weight:700;color:var(--navy);">@yield('page-title', 'Dashboard')</h1>
                <p style="font-size:12px;color:#9CA3AF;margin-top:1px;">@yield('page-subtitle', '')</p>
            </div>
            <div style="display:flex;align-items:center;gap:12px;">
                <div style="text-align:right;">
                    <div style="font-size:13px;font-weight:600;color:var(--navy);">{{ Auth::user()->name }}</div>
                    <div style="font-size:11px;color:#9CA3AF;">
                        {{ Auth::user()->isSuperAdmin() ? 'Super Admin' : Auth::user()->branch?->branch_name }}
                    </div>
                </div>
                <div style="width:38px;height:38px;background:var(--red);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:15px;">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </div>
        </div>

        <div class="page-content">
            @if(session('success'))
            <div class="alert-success" style="margin-bottom:20px;">✅ {{ session('success') }}</div>
            @endif
            @if(session('error'))
            <div class="alert-error" style="margin-bottom:20px;">❌ {{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </div>

</body>

</html>