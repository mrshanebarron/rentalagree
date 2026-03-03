<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'CuraRent' }} — CuraRent Digital Agreements</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script src="{{ asset('build/lucide.min.js') }}"></script>
</head>
<body class="bg-sand min-h-screen font-sans antialiased">
    {{ $slot }}

    @livewireScripts
    <script>
        lucide.createIcons();
        document.addEventListener('livewire:navigated', () => lucide.createIcons());
        if (typeof Livewire !== 'undefined') {
            document.addEventListener('livewire:init', () => {
                Livewire.hook('morph.updated', () => {
                    setTimeout(() => lucide.createIcons(), 100);
                });
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
