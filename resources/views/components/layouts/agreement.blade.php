<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Sign Agreement' }} — CuraRent</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script src="{{ asset('build/lucide.min.js') }}"></script>
</head>
<body class="bg-parchment min-h-screen font-sans antialiased">
    <!-- Minimal header -->
    <header class="bg-navy text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 h-14 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <i data-lucide="car" class="w-5 h-5 text-teal"></i>
                <span class="font-display text-lg font-bold">CuraRent</span>
            </div>
            <span class="text-sm text-white/50">Digital Rental Agreement</span>
        </div>
    </header>

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
