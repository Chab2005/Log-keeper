<!DOCTYPE html>
<html lang="en">
    @php
        $title = $title ?? '';
    @endphp
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LOG KEEPER @if(!empty($title)) - {{ $title }} @endif </title>
        @vite(['resources/css/app.css', 'resources/js/app.ts'])
    </head>

    <body class="flex min-h-screen flex-col bg-background font-sans text-on-background">
        <x-header />

        <main class="flex-1 pt-16">
            <div class="page-content">
                @yield('content')
            </div>
        </main>

        <x-footer />
    </body>
</html>
