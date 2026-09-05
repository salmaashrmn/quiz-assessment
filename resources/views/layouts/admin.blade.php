<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>{{ $title ?? 'Quiz Assessment CMS' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="admin-body">
    <div class="admin-layout">

        <aside class="admin-sidebar">
            <div class="admin-logo">
                Quiz Assessment
            </div>

            <nav class="admin-nav">
                <a
                    href="{{ route('admin.dashboard') }}"
                    class="admin-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                >
                    Dashboard
                </a>
            
                <a
                    href="{{ route('admin.quizzes.index') }}"
                    class="admin-nav-item {{ request()->routeIs('admin.quizzes.*') ? 'active' : '' }}"
                >
                    Quizzes
                </a>
            
                <a
                    href="{{ route('admin.submissions.index') }}"
                    class="admin-nav-item {{ request()->routeIs('admin.submissions.*') ? 'active' : '' }}"
                >
                    Submissions
                </a>
            </nav>
        </aside>

        <div class="admin-main">
            <header class="admin-header">
                <div>
                    <span class="admin-header-label">
                        Admin CMS
                    </span>
                </div>

                <div class="admin-user">
                    <span>{{ auth()->user()->name }}</span>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf

                        <button type="submit" class="logout-button">
                            Logout
                        </button>
                    </form>
                </div>

            </header>

            <main class="admin-content">
                {{ $slot }}
            </main>
        </div>

    </div>

    @livewireScripts
</body>
</html>