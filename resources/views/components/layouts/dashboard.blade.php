<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Dashboard' }} — CuraRent</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-sand min-h-screen font-sans antialiased" x-data="{ sidebarOpen: false }">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="hidden lg:flex lg:flex-col w-64 bg-navy text-white flex-shrink-0 fixed inset-y-0 left-0 z-30">
            <div class="flex items-center gap-2 px-6 h-16 border-b border-white/10">
                <i data-lucide="car" class="w-6 h-6 text-teal"></i>
                <span class="font-display text-xl font-bold">CuraRent</span>
            </div>
            <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('dashboard') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    Dashboard
                </a>
                <a href="{{ route('dashboard.registrations.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('dashboard.registrations.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
                    <i data-lucide="clipboard-list" class="w-5 h-5"></i>
                    Registrations
                </a>
                <a href="{{ route('dashboard.agreements.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('dashboard.agreements.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
                    <i data-lucide="file-signature" class="w-5 h-5"></i>
                    Agreements
                </a>
                <a href="{{ route('dashboard.fleet.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('dashboard.fleet.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
                    <i data-lucide="car-front" class="w-5 h-5"></i>
                    Fleet
                </a>
            </nav>
            <div class="px-3 py-4 border-t border-white/10">
                <div class="flex items-center gap-3 px-3 mb-3">
                    <div class="w-8 h-8 rounded-full bg-teal flex items-center justify-center text-sm font-bold">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-white/50 capitalize">{{ auth()->user()->role }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 px-3 py-2 w-full text-sm text-white/60 hover:text-white hover:bg-white/5 rounded-lg transition-colors">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                        Sign Out
                    </button>
                </form>
            </div>
        </aside>

        <!-- Mobile sidebar -->
        <div x-show="sidebarOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/50 z-40 lg:hidden" @click="sidebarOpen = false" style="display:none"></div>
        <aside x-show="sidebarOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" class="fixed inset-y-0 left-0 w-64 bg-navy text-white z-50 lg:hidden flex flex-col" style="display:none">
            <div class="flex items-center justify-between px-6 h-16 border-b border-white/10">
                <div class="flex items-center gap-2">
                    <i data-lucide="car" class="w-6 h-6 text-teal"></i>
                    <span class="font-display text-xl font-bold">CuraRent</span>
                </div>
                <button @click="sidebarOpen = false" class="text-white/60 hover:text-white">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/70 hover:bg-white/5 hover:text-white transition-colors">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    Dashboard
                </a>
                <a href="{{ route('dashboard.registrations.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/70 hover:bg-white/5 hover:text-white transition-colors">
                    <i data-lucide="clipboard-list" class="w-5 h-5"></i>
                    Registrations
                </a>
                <a href="{{ route('dashboard.agreements.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/70 hover:bg-white/5 hover:text-white transition-colors">
                    <i data-lucide="file-signature" class="w-5 h-5"></i>
                    Agreements
                </a>
                <a href="{{ route('dashboard.fleet.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/70 hover:bg-white/5 hover:text-white transition-colors">
                    <i data-lucide="car-front" class="w-5 h-5"></i>
                    Fleet
                </a>
            </nav>
            <div class="px-3 py-4 border-t border-white/10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 px-3 py-2 w-full text-sm text-white/60 hover:text-white hover:bg-white/5 rounded-lg transition-colors">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                        Sign Out
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main content -->
        <div class="flex-1 lg:ml-64 flex flex-col min-h-screen">
            <!-- Top bar -->
            <header class="bg-white border-b border-warm-gray h-16 flex items-center px-4 sm:px-6 lg:px-8 sticky top-0 z-20">
                <button @click="sidebarOpen = true" class="lg:hidden mr-4 text-charcoal hover:text-navy">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
                <h1 class="font-display text-xl font-semibold text-navy">{{ $header ?? 'Dashboard' }}</h1>
            </header>

            <!-- Page content -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                @if(session('success'))
                    <div class="mb-6 bg-teal/10 border border-teal/20 text-teal-dark rounded-lg px-4 py-3 flex items-center gap-2" x-data="{ show: true }" x-show="show" x-transition>
                        <i data-lucide="check-circle" class="w-5 h-5 flex-shrink-0"></i>
                        <span class="text-sm">{{ session('success') }}</span>
                        <button @click="show = false" class="ml-auto">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-6 bg-terracotta/10 border border-terracotta/20 text-terracotta-dark rounded-lg px-4 py-3 flex items-center gap-2" x-data="{ show: true }" x-show="show" x-transition>
                        <i data-lucide="alert-circle" class="w-5 h-5 flex-shrink-0"></i>
                        <span class="text-sm">{{ session('error') }}</span>
                        <button @click="show = false" class="ml-auto">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </button>
                    </div>
                @endif
                {{ $slot }}
            </main>
        </div>
    </div>

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
