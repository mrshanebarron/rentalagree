<x-layouts.public title="Registration Confirmed">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="bg-white rounded-2xl shadow-xl border border-warm-gray/30 overflow-hidden text-center">
            <!-- Success Header -->
            <div class="bg-teal/5 px-8 py-10 border-b border-teal/10">
                <div class="w-16 h-16 bg-teal/10 rounded-full flex items-center justify-center mx-auto mb-5">
                    <i data-lucide="check-circle" class="w-10 h-10 text-teal"></i>
                </div>
                <h1 class="font-display text-3xl font-bold text-navy mb-2">Pre-Registration Complete</h1>
                <p class="text-charcoal/60">Your information has been submitted successfully</p>
            </div>

            <!-- Confirmation Code -->
            <div class="px-8 py-10">
                <p class="text-sm text-charcoal/60 mb-2 uppercase tracking-wider font-medium">Your Confirmation Code</p>
                <div class="bg-parchment rounded-xl px-8 py-6 mb-8 inline-block border-2 border-dashed border-warm-gray">
                    <span class="font-display text-4xl sm:text-5xl font-bold text-navy tracking-wider">{{ $registration->confirmation_code }}</span>
                </div>

                <div class="bg-sand rounded-xl p-6 mb-8 text-left">
                    <h3 class="font-serif-display text-lg text-navy mb-3 flex items-center gap-2">
                        <i data-lucide="info" class="w-5 h-5 text-teal"></i>
                        What to do next
                    </h3>
                    <ul class="space-y-3 text-sm text-charcoal/70">
                        <li class="flex items-start gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-teal mt-0.5 flex-shrink-0"></i>
                            <span>Save or screenshot this confirmation code</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-teal mt-0.5 flex-shrink-0"></i>
                            <span>Show this code to the CuraRent staff when you arrive at the counter</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-teal mt-0.5 flex-shrink-0"></i>
                            <span>You'll review and sign your rental agreement digitally at the counter</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-teal mt-0.5 flex-shrink-0"></i>
                            <span>Bring your driver's license and passport/ID for verification</span>
                        </li>
                    </ul>
                </div>

                <!-- Summary -->
                <div class="text-left space-y-3 text-sm border-t border-warm-gray/30 pt-6">
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Name</span>
                        <span class="font-medium text-charcoal">{{ $registration->full_name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Pickup Date</span>
                        <span class="font-medium text-charcoal">{{ $registration->pickup_date->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Return Date</span>
                        <span class="font-medium text-charcoal">{{ $registration->return_date->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Vehicle Preference</span>
                        <span class="font-medium text-charcoal capitalize">{{ $registration->vehicle_preference }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.public>
