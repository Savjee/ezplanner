<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>{{ config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <main>
            <header>
                <h1>EZPlanner</h1>
            </header>

            {{ $slot }}
        </main>

        @livewireScriptConfig
        <script>
            const newUrl = "{{ config('app.url') . '/livewire/update' }}".replace('//', '/');
            window.livewireScriptConfig.uri = newUrl;
        </script>
    </body>
</html>
