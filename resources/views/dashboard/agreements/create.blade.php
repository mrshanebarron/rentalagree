<x-layouts.dashboard title="Start Agreement" header="Start Agreement">
    <div class="max-w-3xl">
        <div class="bg-white rounded-xl border border-warm-gray/30 p-6 mb-6">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 bg-navy/10 rounded-xl flex items-center justify-center">
                    <i data-lucide="user" class="w-6 h-6 text-navy"></i>
                </div>
                <div>
                    <h2 class="font-serif-display text-xl text-navy">{{ $registration->full_name }}</h2>
                    <p class="text-sm text-charcoal/50">{{ $registration->confirmation_code }} &bull; {{ $registration->pickup_date->format('M d') }} - {{ $registration->return_date->format('M d, Y') }} ({{ $registration->rental_days }} days)</p>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('dashboard.agreements.create', $registration) }}" class="space-y-6">
            @csrf

            <!-- Vehicle Selection -->
            <div class="bg-white rounded-xl border border-warm-gray/30 overflow-hidden">
                <div class="bg-parchment px-6 py-4 border-b border-warm-gray/30">
                    <h3 class="font-serif-display text-lg text-navy flex items-center gap-2">
                        <i data-lucide="car" class="w-5 h-5 text-teal"></i>
                        Select Vehicle
                    </h3>
                </div>
                <div class="p-6">
                    @if($vehicles->count())
                    <div class="grid gap-3">
                        @foreach($vehicles as $vehicle)
                        <label class="flex items-center gap-4 p-4 rounded-lg border border-warm-gray/50 hover:border-teal/50 hover:bg-teal/5 cursor-pointer transition-all has-[:checked]:border-teal has-[:checked]:bg-teal/5">
                            <input type="radio" name="vehicle_id" value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'checked' : '' }} class="w-4 h-4 text-teal focus:ring-teal/20 border-warm-gray">
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-charcoal">{{ $vehicle->full_name }}</p>
                                        <p class="text-xs text-charcoal/50">{{ $vehicle->license_plate }} &bull; {{ $vehicle->color }} &bull; {{ number_format($vehicle->current_mileage) }} km</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold text-navy">${{ number_format($vehicle->daily_rate, 2) }}<span class="text-xs font-normal text-charcoal/50">/day</span></p>
                                        <p class="text-xs text-teal font-medium capitalize">{{ $vehicle->category }}</p>
                                    </div>
                                </div>
                            </div>
                        </label>
                        @endforeach
                    </div>
                    @else
                    <p class="text-charcoal/50 text-center py-4">No available vehicles.</p>
                    @endif
                    @error('vehicle_id') <p class="mt-2 text-sm text-terracotta">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Insurance & Deposit -->
            <div class="bg-white rounded-xl border border-warm-gray/30 overflow-hidden">
                <div class="bg-parchment px-6 py-4 border-b border-warm-gray/30">
                    <h3 class="font-serif-display text-lg text-navy flex items-center gap-2">
                        <i data-lucide="shield" class="w-5 h-5 text-teal"></i>
                        Insurance & Deposit
                    </h3>
                </div>
                <div class="p-6 space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-2">Insurance Option</label>
                        <div class="grid gap-3">
                            <label class="flex items-center gap-3 p-4 rounded-lg border border-warm-gray/50 hover:border-teal/50 cursor-pointer transition-all has-[:checked]:border-teal has-[:checked]:bg-teal/5">
                                <input type="radio" name="insurance_option" value="basic" {{ old('insurance_option', 'basic') === 'basic' ? 'checked' : '' }} class="w-4 h-4 text-teal focus:ring-teal/20 border-warm-gray">
                                <div class="flex-1 flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-charcoal">Basic CDW</p>
                                        <p class="text-xs text-charcoal/50">Collision Damage Waiver with $500 deductible</p>
                                    </div>
                                    <span class="font-semibold text-navy">$15/day</span>
                                </div>
                            </label>
                            <label class="flex items-center gap-3 p-4 rounded-lg border border-warm-gray/50 hover:border-teal/50 cursor-pointer transition-all has-[:checked]:border-teal has-[:checked]:bg-teal/5">
                                <input type="radio" name="insurance_option" value="premium" {{ old('insurance_option') === 'premium' ? 'checked' : '' }} class="w-4 h-4 text-teal focus:ring-teal/20 border-warm-gray">
                                <div class="flex-1 flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-charcoal">Premium CDW</p>
                                        <p class="text-xs text-charcoal/50">Full coverage with $0 deductible + tire/glass</p>
                                    </div>
                                    <span class="font-semibold text-navy">$25/day</span>
                                </div>
                            </label>
                            <label class="flex items-center gap-3 p-4 rounded-lg border border-warm-gray/50 hover:border-teal/50 cursor-pointer transition-all has-[:checked]:border-teal has-[:checked]:bg-teal/5">
                                <input type="radio" name="insurance_option" value="none" {{ old('insurance_option') === 'none' ? 'checked' : '' }} class="w-4 h-4 text-teal focus:ring-teal/20 border-warm-gray">
                                <div class="flex-1 flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-charcoal">No Insurance</p>
                                        <p class="text-xs text-charcoal/50">Customer assumes full liability</p>
                                    </div>
                                    <span class="font-semibold text-charcoal/40">$0/day</span>
                                </div>
                            </label>
                        </div>
                        @error('insurance_option') <p class="mt-2 text-sm text-terracotta">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Security Deposit (USD)</label>
                        <input type="number" name="deposit_amount" value="{{ old('deposit_amount', 300) }}" min="0" step="0.01" class="w-full px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all">
                        @error('deposit_amount') <p class="mt-1 text-sm text-terracotta">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('dashboard.registrations.show', $registration) }}" class="inline-flex items-center gap-1 text-sm text-charcoal/50 hover:text-charcoal transition-colors">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Back
                </a>
                <button type="submit" class="inline-flex items-center gap-2 bg-teal hover:bg-teal-light text-white px-8 py-3 rounded-lg font-medium transition-colors shadow-sm">
                    <i data-lucide="file-signature" class="w-5 h-5"></i>
                    Create Agreement
                </button>
            </div>
        </form>
    </div>
</x-layouts.dashboard>
