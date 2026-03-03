<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'CuraRent' }} — Digital Car Rental Agreements</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-sand min-h-screen font-sans antialiased">
    <!-- Public Navigation -->
    <nav class="bg-navy text-white" x-data="{ mobileOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="/" class="flex items-center gap-2">
                    <i data-lucide="car" class="w-7 h-7 text-teal"></i>
                    <span class="font-display text-2xl font-bold tracking-tight">CuraRent</span>
                </a>
                <div class="hidden md:flex items-center gap-6">
                    <a href="/" class="text-white/80 hover:text-white transition-colors text-sm font-medium">Home</a>
                    <a href="/register" class="text-white/80 hover:text-white transition-colors text-sm font-medium">Pre-Register</a>
                    <a href="/login" class="inline-flex items-center gap-1.5 bg-teal hover:bg-teal-light text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                        <i data-lucide="log-in" class="w-4 h-4"></i>
                        Staff Login
                    </a>
                </div>
                <button @click="mobileOpen = !mobileOpen" class="md:hidden text-white">
                    <i x-show="!mobileOpen" data-lucide="menu" class="w-6 h-6"></i>
                    <i x-show="mobileOpen" data-lucide="x" class="w-6 h-6" style="display:none"></i>
                </button>
            </div>
        </div>
        <div x-show="mobileOpen" x-transition class="md:hidden border-t border-white/10" style="display:none">
            <div class="px-4 py-3 space-y-2">
                <a href="/" class="block text-white/80 hover:text-white py-2">Home</a>
                <a href="/register" class="block text-white/80 hover:text-white py-2">Pre-Register</a>
                <a href="/login" class="block text-white/80 hover:text-white py-2">Staff Login</a>
            </div>
        </div>
    </nav>

    {{ $slot }}

    <!-- Footer -->
    <footer class="bg-navy text-white/70 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <i data-lucide="car" class="w-6 h-6 text-teal"></i>
                        <span class="font-display text-xl font-bold text-white">CuraRent</span>
                    </div>
                    <p class="text-sm leading-relaxed">Your trusted car rental partner in Curacao. Explore the island at your own pace with our reliable fleet.</p>
                </div>
                <div>
                    <h4 class="font-display text-lg font-semibold text-white mb-4">Contact</h4>
                    <div class="space-y-2 text-sm">
                        <div class="flex items-center gap-2">
                            <i data-lucide="map-pin" class="w-4 h-4 text-teal"></i>
                            <span>Kaya Damasco 12, Willemstad, Curacao</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i data-lucide="phone" class="w-4 h-4 text-teal"></i>
                            <span>+599 9 461 2345</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i data-lucide="mail" class="w-4 h-4 text-teal"></i>
                            <span>info@curarent.com</span>
                        </div>
                    </div>
                </div>
                <div>
                    <h4 class="font-display text-lg font-semibold text-white mb-4">Hours</h4>
                    <div class="space-y-1 text-sm">
                        <p>Monday - Saturday: 7:00 AM - 8:00 PM</p>
                        <p>Sunday: 8:00 AM - 6:00 PM</p>
                        <p class="text-teal mt-2">Airport desk available 24/7</p>
                    </div>
                </div>
            </div>
            <div class="border-t border-white/10 mt-8 pt-6 text-center text-xs">
                <p>&copy; {{ date('Y') }} CuraRent. All rights reserved. Willemstad, Curacao.</p>
            </div>
        </div>
    </footer>

    <script>lucide.createIcons();</script>
    @stack('scripts')
</body>
</html>
