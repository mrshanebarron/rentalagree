<x-layouts.dashboard title="Registration {{ $registration->confirmation_code }}" header="Registration Details">
    <div class="max-w-4xl">
        <!-- Header with status and actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <div class="flex items-center gap-3 mb-1">
                    <span class="font-mono text-lg font-bold text-navy">{{ $registration->confirmation_code }}</span>
                    @php
                        $colors = ['pending' => 'bg-yellow-100 text-yellow-800', 'in_progress' => 'bg-blue-100 text-blue-800', 'completed' => 'bg-green-100 text-green-800', 'expired' => 'bg-red-100 text-red-800'];
                    @endphp
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $colors[$registration->status] }}">
                        {{ str_replace('_', ' ', ucfirst($registration->status)) }}
                    </span>
                </div>
                <p class="text-sm text-charcoal/50">Registered {{ $registration->created_at->format('M d, Y \a\t g:i A') }}</p>
            </div>
            @if($registration->status === 'pending')
                <a href="{{ route('dashboard.agreements.start', $registration) }}" class="inline-flex items-center gap-2 bg-teal hover:bg-teal-light text-white px-6 py-2.5 rounded-lg font-medium transition-colors shadow-sm">
                    <i data-lucide="file-signature" class="w-5 h-5"></i>
                    Start Agreement
                </a>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Personal Information -->
            <div class="bg-white rounded-xl border border-warm-gray/30 overflow-hidden">
                <div class="bg-parchment px-5 py-3 border-b border-warm-gray/30">
                    <h3 class="font-serif-display text-base text-navy flex items-center gap-2">
                        <i data-lucide="user" class="w-4 h-4 text-teal"></i>
                        Personal Information
                    </h3>
                </div>
                <div class="px-5 py-4 space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Full Name</span>
                        <span class="font-medium text-charcoal">{{ $registration->full_name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Email</span>
                        <span class="font-medium text-charcoal">{{ $registration->email }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Phone</span>
                        <span class="font-medium text-charcoal">{{ $registration->phone }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Date of Birth</span>
                        <span class="font-medium text-charcoal">{{ $registration->date_of_birth->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Driver's License -->
            <div class="bg-white rounded-xl border border-warm-gray/30 overflow-hidden">
                <div class="bg-parchment px-5 py-3 border-b border-warm-gray/30">
                    <h3 class="font-serif-display text-base text-navy flex items-center gap-2">
                        <i data-lucide="id-card" class="w-4 h-4 text-teal"></i>
                        Driver's License
                    </h3>
                </div>
                <div class="px-5 py-4 space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">License Number</span>
                        <span class="font-medium text-charcoal">{{ $registration->license_number }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Country</span>
                        <span class="font-medium text-charcoal">{{ $registration->license_country }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Expiry</span>
                        <span class="font-medium text-charcoal">{{ $registration->license_expiry->format('M d, Y') }}</span>
                    </div>
                    @if($registration->license_front_photo)
                    <div class="flex gap-2 pt-2">
                        <img src="{{ Storage::url($registration->license_front_photo) }}" alt="License Front" class="w-20 h-14 object-cover rounded border">
                        @if($registration->license_back_photo)
                        <img src="{{ Storage::url($registration->license_back_photo) }}" alt="License Back" class="w-20 h-14 object-cover rounded border">
                        @endif
                    </div>
                    @endif
                </div>
            </div>

            <!-- Emergency Contact -->
            <div class="bg-white rounded-xl border border-warm-gray/30 overflow-hidden">
                <div class="bg-parchment px-5 py-3 border-b border-warm-gray/30">
                    <h3 class="font-serif-display text-base text-navy flex items-center gap-2">
                        <i data-lucide="heart-pulse" class="w-4 h-4 text-teal"></i>
                        Emergency Contact
                    </h3>
                </div>
                <div class="px-5 py-4 space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Name</span>
                        <span class="font-medium text-charcoal">{{ $registration->emergency_contact_name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Phone</span>
                        <span class="font-medium text-charcoal">{{ $registration->emergency_contact_phone }}</span>
                    </div>
                </div>
            </div>

            <!-- Rental Details -->
            <div class="bg-white rounded-xl border border-warm-gray/30 overflow-hidden">
                <div class="bg-parchment px-5 py-3 border-b border-warm-gray/30">
                    <h3 class="font-serif-display text-base text-navy flex items-center gap-2">
                        <i data-lucide="calendar" class="w-4 h-4 text-teal"></i>
                        Rental Details
                    </h3>
                </div>
                <div class="px-5 py-4 space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Pickup</span>
                        <span class="font-medium text-charcoal">{{ $registration->pickup_date->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Return</span>
                        <span class="font-medium text-charcoal">{{ $registration->return_date->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Duration</span>
                        <span class="font-medium text-charcoal">{{ $registration->rental_days }} days</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Vehicle Preference</span>
                        <span class="font-medium text-charcoal capitalize">{{ $registration->vehicle_preference }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Hotel</span>
                        <span class="font-medium text-charcoal">{{ $registration->hotel_name }}</span>
                    </div>
                    @if($registration->flight_number)
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Flight</span>
                        <span class="font-medium text-charcoal">{{ $registration->flight_number }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Existing Agreements -->
        @if($registration->agreements->count())
        <div class="mt-6 bg-white rounded-xl border border-warm-gray/30 overflow-hidden">
            <div class="px-5 py-3 border-b border-warm-gray/30">
                <h3 class="font-serif-display text-base text-navy">Related Agreements</h3>
            </div>
            <div class="divide-y divide-warm-gray/30">
                @foreach($registration->agreements as $agreement)
                <div class="px-5 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <span class="font-mono text-sm font-semibold text-navy">{{ $agreement->agreement_number }}</span>
                        @if($agreement->vehicle)
                        <span class="text-sm text-charcoal/60">{{ $agreement->vehicle->full_name }}</span>
                        @endif
                        @php
                            $aColors = ['draft' => 'bg-gray-100 text-gray-700', 'in_progress' => 'bg-blue-100 text-blue-800', 'signed' => 'bg-green-100 text-green-800', 'expired' => 'bg-red-100 text-red-800'];
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $aColors[$agreement->status] }}">
                            {{ str_replace('_', ' ', ucfirst($agreement->status)) }}
                        </span>
                    </div>
                    <a href="{{ route('dashboard.agreements.show', $agreement) }}" class="text-teal hover:text-teal-dark text-sm font-medium transition-colors">View</a>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="mt-6">
            <a href="{{ route('dashboard.registrations.index') }}" class="inline-flex items-center gap-1 text-sm text-charcoal/50 hover:text-charcoal transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back to Registrations
            </a>
        </div>
    </div>
</x-layouts.dashboard>
