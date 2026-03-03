<x-layouts.public title="Staff Login">
    <div class="min-h-[calc(100vh-200px)] flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-2xl shadow-xl border border-warm-gray/30 overflow-hidden">
                <!-- Header -->
                <div class="bg-navy px-8 py-8 text-center">
                    <div class="flex items-center justify-center gap-2 mb-3">
                        <i data-lucide="car" class="w-8 h-8 text-teal"></i>
                        <span class="font-display text-2xl font-bold text-white">CuraRent</span>
                    </div>
                    <p class="text-white/60 text-sm">Staff Portal</p>
                </div>

                <!-- Form -->
                <div class="px-8 py-8" x-data="{ email: '', password: '' }">
                    <form method="POST" action="/login" class="space-y-5">
                        @csrf
                        <div>
                            <label for="email" class="block text-sm font-medium text-charcoal mb-1.5">Email</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                x-model="email"
                                :value="email"
                                required
                                autofocus
                                class="w-full px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all text-charcoal"
                                placeholder="your@email.com"
                            >
                            @error('email')
                                <p class="mt-1 text-sm text-terracotta">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-charcoal mb-1.5">Password</label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                x-model="password"
                                :value="password"
                                required
                                class="w-full px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all text-charcoal"
                                placeholder="Enter your password"
                            >
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded border-warm-gray text-teal focus:ring-teal/20">
                            <label for="remember" class="ml-2 text-sm text-charcoal/70">Remember me</label>
                        </div>
                        <button type="submit" class="w-full bg-teal hover:bg-teal-light text-white py-3 rounded-lg font-medium transition-colors shadow-sm">
                            Sign In
                        </button>
                    </form>

                    <!-- Demo credentials -->
                    <div class="mt-6 pt-6 border-t border-warm-gray/50">
                        <p class="text-xs text-charcoal/50 text-center mb-3 uppercase tracking-wider font-medium">Demo Credentials</p>
                        <div class="space-y-2">
                            <button
                                @click="email = 'admin@curarent.com'; password = 'RentalAgree!Demo2026'; $nextTick(() => { document.getElementById('email').value = email; document.getElementById('password').value = password; })"
                                class="w-full flex items-center justify-between px-4 py-2.5 bg-sand hover:bg-parchment rounded-lg border border-warm-gray/50 transition-colors group cursor-pointer"
                            >
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-navy rounded-full flex items-center justify-center">
                                        <span class="text-white text-xs font-bold">M</span>
                                    </div>
                                    <div class="text-left">
                                        <p class="text-sm font-medium text-charcoal">Maria van der Berg</p>
                                        <p class="text-xs text-charcoal/50">Admin</p>
                                    </div>
                                </div>
                                <i data-lucide="mouse-pointer-click" class="w-4 h-4 text-charcoal/30 group-hover:text-teal transition-colors"></i>
                            </button>
                            <button
                                @click="email = 'carlos@curarent.com'; password = 'RentalAgree!Demo2026'; $nextTick(() => { document.getElementById('email').value = email; document.getElementById('password').value = password; })"
                                class="w-full flex items-center justify-between px-4 py-2.5 bg-sand hover:bg-parchment rounded-lg border border-warm-gray/50 transition-colors group cursor-pointer"
                            >
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-teal rounded-full flex items-center justify-center">
                                        <span class="text-white text-xs font-bold">C</span>
                                    </div>
                                    <div class="text-left">
                                        <p class="text-sm font-medium text-charcoal">Carlos Rosario</p>
                                        <p class="text-xs text-charcoal/50">Staff</p>
                                    </div>
                                </div>
                                <i data-lucide="mouse-pointer-click" class="w-4 h-4 text-charcoal/30 group-hover:text-teal transition-colors"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.public>
