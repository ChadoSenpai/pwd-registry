<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') | PWD Registry</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body data-bs-theme="light" class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <nav class="app-header navbar navbar-expand bg-white border-bottom">
            <div class="container-fluid">
                <span class="navbar-text text-muted fw-medium">Persons with Disabilities Registry Management System</span>
                <div class="ms-auto d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center gap-2">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-circle" style="width: 32px; height: 32px;"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-primary"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div>
                        <span class="small text-muted fw-semibold">{{ auth()->user()->name }}</span>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-primary dropdown-toggle d-flex align-items-center gap-2" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                            Settings
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('settings.password') }}"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v4"/></svg> Change Password</a>
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('settings.google-authenticator') }}"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v4"/></svg> Google Authenticator</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item d-flex align-items-center gap-2"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg> Sign out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <aside class="app-sidebar shadow" data-bs-theme="dark">
            <div class="sidebar-brand"><a href="{{ route('dashboard') }}" class="brand-link"><span
                        class="brand-mark">PR</span><span class="brand-text fw-semibold">PWD Registry</span></a></div>
            <div class="sidebar-wrapper">
                <nav class="mt-3">
                    <ul class="nav sidebar-menu flex-column nav-pills" role="menu">
                        <li class="nav-item"><a href="{{ route('dashboard') }}"
                                class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"><svg
                                    class="sidebar-icon" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M4 4h6v6H4V4Zm10 0h6v6h-6V4ZM4 14h6v6H4v-6Zm10 0h6v6h-6v-6Z" />
                                </svg>Dashboard</a></li>
                        <li class="nav-header text-uppercase small">Registry</li>
                        <li class="nav-item"><a href="{{ route('registrants.index') }}"
                                class="nav-link {{ request()->routeIs('registrants.*') ? 'active' : '' }}"><svg
                                    class="sidebar-icon" viewBox="0 0 24 24" aria-hidden="true">
                                    <path
                                        d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm0 2c-4.42 0-8 2.01-8 4.5V20h16v-1.5c0-2.49-3.58-4.5-8-4.5Z" />
                                </svg>PWD Registrants</a></li>
                        <li class="nav-item"><a href="{{ route('applications.index') }}"
                                class="nav-link {{ request()->routeIs('applications.index') ? 'active' : '' }}"><svg
                                    class="sidebar-icon" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M6 2h9l5 5v15H6V2Zm8 1.5V8h4.5L14 3.5ZM9 12h6v2H9v-2Zm0 4h6v2H9v-2Z" />
                                </svg>Applications</a></li>
                        <li class="nav-item"><a href="/archive-applications"
                                class="nav-link {{ request()->is('archive-applications') ? 'active' : '' }}"><svg
                                    class="sidebar-icon" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M5 4h14l-1 2H6L5 4Zm2 3h10l-1 12H8L7 7Z" />
                                </svg>Archive</a></li>
                        <li class="nav-item"><a href="{{ route('applications.audit-trail') }}"
                                class="nav-link {{ request()->routeIs('applications.audit-trail') ? 'active' : '' }}"><svg
                                    class="sidebar-icon" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M5 4h14v2H5V4Zm0 5h14v2H5V9Zm0 5h8v2H5v-2Z" />
                                </svg>Audit Trails</a></li>
                    </ul>
                </nav>
            </div>
        </aside>
        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h1 class="mb-0">@yield('page_title', 'Dashboard')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Home</a></li>
                                <li class="breadcrumb-item active">@yield('page_title', 'Dashboard')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-content">
                <div class="container-fluid">@yield('content')</div>
            </div>
        </main>
        <footer class="app-footer"><span>&copy; {{ now()->year }} PWD Registry.</span><span
                class="float-end d-none d-sm-inline">Local Government Unit</span></footer>
    </div>
</body>

</html>
