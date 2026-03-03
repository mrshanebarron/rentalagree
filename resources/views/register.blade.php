<x-layouts.public title="Pre-Register">
    <!-- Hero Banner -->
    <div class="relative bg-navy py-12 overflow-hidden">
        <img src="/images/signing-contract.jpg" alt="Digital signing" class="absolute inset-0 w-full h-full object-cover opacity-20">
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-display text-3xl sm:text-4xl font-bold text-white mb-3">Pre-Register for Your Rental</h1>
            <p class="text-white/70 max-w-2xl mx-auto">Complete your information now and skip the paperwork when you arrive. You'll receive a confirmation code to present at the counter.</p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <form method="POST" action="/register" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- Personal Information -->
            <div class="bg-white rounded-xl border border-warm-gray/50 shadow-sm overflow-hidden">
                <div class="bg-parchment px-6 py-4 border-b border-warm-gray/50">
                    <h2 class="font-serif-display text-xl text-navy flex items-center gap-2">
                        <i data-lucide="user" class="w-5 h-5 text-teal"></i>
                        Personal Information
                    </h2>
                </div>
                <div class="px-6 py-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-charcoal mb-1">Full Name <span class="text-terracotta">*</span></label>
                        <input type="text" name="full_name" value="{{ old('full_name') }}" required class="w-full px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all">
                        @error('full_name') <p class="mt-1 text-sm text-terracotta">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Email <span class="text-terracotta">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all">
                        @error('email') <p class="mt-1 text-sm text-terracotta">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Phone Number <span class="text-terracotta">*</span></label>
                        <input type="tel" name="phone" value="{{ old('phone') }}" required placeholder="+1 555 123 4567" class="w-full px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all">
                        @error('phone') <p class="mt-1 text-sm text-terracotta">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Date of Birth <span class="text-terracotta">*</span></label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" required class="w-full px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all">
                        @error('date_of_birth') <p class="mt-1 text-sm text-terracotta">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Driver's License -->
            <div class="bg-white rounded-xl border border-warm-gray/50 shadow-sm overflow-hidden">
                <div class="bg-parchment px-6 py-4 border-b border-warm-gray/50">
                    <h2 class="font-serif-display text-xl text-navy flex items-center gap-2">
                        <i data-lucide="id-card" class="w-5 h-5 text-teal"></i>
                        Driver's License
                    </h2>
                </div>
                <div class="px-6 py-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">License Number <span class="text-terracotta">*</span></label>
                        <input type="text" name="license_number" value="{{ old('license_number') }}" required class="w-full px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all">
                        @error('license_number') <p class="mt-1 text-sm text-terracotta">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Country of Issue <span class="text-terracotta">*</span></label>
                        <input type="text" name="license_country" value="{{ old('license_country') }}" required placeholder="e.g. United States" class="w-full px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all">
                        @error('license_country') <p class="mt-1 text-sm text-terracotta">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Expiry Date <span class="text-terracotta">*</span></label>
                        <input type="date" name="license_expiry" value="{{ old('license_expiry') }}" required class="w-full px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all">
                        @error('license_expiry') <p class="mt-1 text-sm text-terracotta">{{ $message }}</p> @enderror
                    </div>
                    <div class="sm:col-span-2 grid grid-cols-1 sm:grid-cols-3 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-charcoal mb-1">License Front Photo</label>
                            <input type="file" name="license_front_photo" accept="image/*" class="w-full text-sm text-charcoal file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-navy/5 file:text-navy hover:file:bg-navy/10 file:cursor-pointer">
                            @error('license_front_photo') <p class="mt-1 text-sm text-terracotta">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-charcoal mb-1">License Back Photo</label>
                            <input type="file" name="license_back_photo" accept="image/*" class="w-full text-sm text-charcoal file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-navy/5 file:text-navy hover:file:bg-navy/10 file:cursor-pointer">
                            @error('license_back_photo') <p class="mt-1 text-sm text-terracotta">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-charcoal mb-1">Passport/ID Photo</label>
                            <input type="file" name="passport_photo" accept="image/*" class="w-full text-sm text-charcoal file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-navy/5 file:text-navy hover:file:bg-navy/10 file:cursor-pointer">
                            @error('passport_photo') <p class="mt-1 text-sm text-terracotta">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Emergency Contact -->
            <div class="bg-white rounded-xl border border-warm-gray/50 shadow-sm overflow-hidden">
                <div class="bg-parchment px-6 py-4 border-b border-warm-gray/50">
                    <h2 class="font-serif-display text-xl text-navy flex items-center gap-2">
                        <i data-lucide="heart-pulse" class="w-5 h-5 text-teal"></i>
                        Emergency Contact
                    </h2>
                </div>
                <div class="px-6 py-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Contact Name <span class="text-terracotta">*</span></label>
                        <input type="text" name="emergency_contact_name" value="{{ old('emergency_contact_name') }}" required class="w-full px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all">
                        @error('emergency_contact_name') <p class="mt-1 text-sm text-terracotta">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Contact Phone <span class="text-terracotta">*</span></label>
                        <input type="tel" name="emergency_contact_phone" value="{{ old('emergency_contact_phone') }}" required class="w-full px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all">
                        @error('emergency_contact_phone') <p class="mt-1 text-sm text-terracotta">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Rental Details -->
            <div class="bg-white rounded-xl border border-warm-gray/50 shadow-sm overflow-hidden">
                <div class="bg-parchment px-6 py-4 border-b border-warm-gray/50">
                    <h2 class="font-serif-display text-xl text-navy flex items-center gap-2">
                        <i data-lucide="calendar" class="w-5 h-5 text-teal"></i>
                        Rental Details
                    </h2>
                </div>
                <div class="px-6 py-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Pickup Date <span class="text-terracotta">*</span></label>
                        <input type="date" name="pickup_date" value="{{ old('pickup_date') }}" required class="w-full px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all">
                        @error('pickup_date') <p class="mt-1 text-sm text-terracotta">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Return Date <span class="text-terracotta">*</span></label>
                        <input type="date" name="return_date" value="{{ old('return_date') }}" required class="w-full px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all">
                        @error('return_date') <p class="mt-1 text-sm text-terracotta">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Vehicle Preference <span class="text-terracotta">*</span></label>
                        <select name="vehicle_preference" required class="w-full px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all bg-white">
                            <option value="">Select category...</option>
                            <option value="economy" {{ old('vehicle_preference') === 'economy' ? 'selected' : '' }}>Economy (from $32/day)</option>
                            <option value="compact" {{ old('vehicle_preference') === 'compact' ? 'selected' : '' }}>Compact (from $50/day)</option>
                            <option value="suv" {{ old('vehicle_preference') === 'suv' ? 'selected' : '' }}>SUV (from $75/day)</option>
                            <option value="luxury" {{ old('vehicle_preference') === 'luxury' ? 'selected' : '' }}>Luxury (from $120/day)</option>
                        </select>
                        @error('vehicle_preference') <p class="mt-1 text-sm text-terracotta">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Hotel/Accommodation <span class="text-terracotta">*</span></label>
                        <input type="text" name="hotel_name" value="{{ old('hotel_name') }}" required placeholder="e.g. Marriott Beach Resort" class="w-full px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all">
                        @error('hotel_name') <p class="mt-1 text-sm text-terracotta">{{ $message }}</p> @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-charcoal mb-1">Flight Arrival Number <span class="text-charcoal/40">(optional)</span></label>
                        <input type="text" name="flight_number" value="{{ old('flight_number') }}" placeholder="e.g. AA1847" class="w-full px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all">
                        @error('flight_number') <p class="mt-1 text-sm text-terracotta">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="flex justify-end">
                <button type="submit" class="inline-flex items-center gap-2 bg-teal hover:bg-teal-light text-white px-8 py-3.5 rounded-lg font-medium transition-colors shadow-lg shadow-teal/25 text-lg">
                    <i data-lucide="send" class="w-5 h-5"></i>
                    Pre-Register Now
                </button>
            </div>
        </form>
    </div>
</x-layouts.public>
