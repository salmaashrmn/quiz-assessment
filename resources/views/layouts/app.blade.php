<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>{{ $title ?? 'Quiz Assessment' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="min-h-screen bg-gray-50 text-gray-900">
    <header class="bg-header">
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
            <a
                href="{{ route('quizzes.index') }}"
                class="header-font text-xl font-bold"
            >
                Quiz Assessment
            </a>

            <a
                href="{{ route('quizzes.index') }}"
                class="text-sm text-white hover:text-white-500"
            >
                Quizzes
            </a>
        </nav>
    </header>

    <main class="mx-auto min-h-[calc(100vh-145px)] max-w-7xl px-6 py-8">
        {{ $slot }}
    </main>

    <footer class="bg-header">
        <div class="mx-auto max-w-7xl px-6 py-6 text-center text-sm text-white">
            © {{ date('Y') }} Quiz Assessment. All rights reserved.
        </div>
    </footer>

    @livewireScripts
</body>
</html>