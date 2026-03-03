<x-layouts.agreement title="Agreement Signed">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="bg-white rounded-2xl shadow-xl border border-warm-gray/30 overflow-hidden text-center">
            <!-- Success Header -->
            <div class="bg-teal/5 px-8 py-10 border-b border-teal/10">
                <div class="w-16 h-16 bg-teal/10 rounded-full flex items-center justify-center mx-auto mb-5">
                    <i data-lucide="check-circle" class="w-10 h-10 text-teal"></i>
                </div>
                <h1 class="font-display text-3xl font-bold text-navy mb-2">Agreement Signed</h1>
                <p class="text-charcoal/60">Your rental agreement has been completed successfully</p>
            </div>

            <div class="px-8 py-10">
                <!-- Agreement Info -->
                <div class="bg-parchment rounded-xl p-6 mb-8 border border-warm-gray/30">
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-charcoal/60">Agreement Number</span>
                            <span class="font-mono font-bold text-navy">{{ $agreement->agreement_number }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-charcoal/60">Customer</span>
                            <span class="font-medium text-charcoal">{{ $agreement->registration->full_name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-charcoal/60">Vehicle</span>
                            <span class="font-medium text-charcoal">{{ $agreement->vehicle->full_name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-charcoal/60">License Plate</span>
                            <span class="font-mono font-medium text-charcoal">{{ $agreement->vehicle->license_plate }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-charcoal/60">Rental Period</span>
                            <span class="font-medium text-charcoal">{{ $agreement->pickup_date->format('M d') }} - {{ $agreement->return_date->format('M d, Y') }}</span>
                        </div>
                        @if($agreement->signed_at)
                        <div class="flex justify-between">
                            <span class="text-charcoal/60">Signed At</span>
                            <span class="font-medium text-charcoal">{{ $agreement->signed_at->format('M d, Y \a\t g:i A') }}</span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Instructions -->
                <div class="bg-sand rounded-xl p-6 text-left">
                    <h3 class="font-serif-display text-lg text-navy mb-3 flex items-center gap-2">
                        <i data-lucide="info" class="w-5 h-5 text-teal"></i>
                        Important Reminders
                    </h3>
                    <ul class="space-y-3 text-sm text-charcoal/70">
                        <li class="flex items-start gap-2">
                            <i data-lucide="fuel" class="w-4 h-4 text-teal mt-0.5 flex-shrink-0"></i>
                            <span>Return the vehicle with a full tank of fuel to avoid refueling charges</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i data-lucide="phone" class="w-4 h-4 text-teal mt-0.5 flex-shrink-0"></i>
                            <span>For roadside assistance, call CuraRent at +599 9 461 2345</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i data-lucide="calendar" class="w-4 h-4 text-teal mt-0.5 flex-shrink-0"></i>
                            <span>Vehicle must be returned by {{ $agreement->return_date->format('M d, Y') }}</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i data-lucide="map-pin" class="w-4 h-4 text-teal mt-0.5 flex-shrink-0"></i>
                            <span>Return location: CuraRent, Kaya Damasco 12, Willemstad</span>
                        </li>
                    </ul>
                </div>

                <p class="text-sm text-charcoal/40 mt-6">A copy of your signed agreement will be available from the rental counter. Enjoy your time in Curacao!</p>
            </div>
        </div>
    </div>
</x-layouts.agreement>
