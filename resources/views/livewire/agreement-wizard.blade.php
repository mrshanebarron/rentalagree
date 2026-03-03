<div>
    <!-- Progress Bar -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-3">
            <h1 class="font-display text-2xl font-bold text-navy">Rental Agreement</h1>
            <span class="text-sm text-charcoal/50">Step {{ $currentStep }} of 8</span>
        </div>
        <div class="flex gap-1.5">
            @for($i = 1; $i <= 8; $i++)
                <div class="flex-1 h-2 rounded-full transition-colors duration-300 {{ $i <= $currentStep ? 'bg-teal' : 'bg-warm-gray/40' }} {{ $i < $currentStep ? 'cursor-pointer' : '' }}"
                    @if($i < $currentStep) wire:click="goToStep({{ $i }})" @endif></div>
            @endfor
        </div>
        <div class="flex justify-between mt-2 text-xs text-charcoal/40">
            <span>Vehicle</span>
            <span>Rates</span>
            <span>Rules</span>
            <span>Damage</span>
            <span>Fuel</span>
            <span>Prohibited</span>
            <span>Drivers</span>
            <span>Sign</span>
        </div>
    </div>

    <!-- Step 1: Vehicle Information -->
    @if($currentStep === 1)
    <div class="bg-white rounded-xl shadow-sm border border-warm-gray/30 overflow-hidden">
        <div class="bg-navy px-6 py-4">
            <h2 class="font-serif-display text-xl text-white flex items-center gap-2">
                <i data-lucide="car" class="w-5 h-5 text-teal"></i>
                Step 1: Vehicle Information
            </h2>
        </div>
        <div class="p-6">
            <p class="text-sm text-charcoal/60 mb-6">Please review the vehicle assigned to your rental. Confirm the details below are correct.</p>

            <div class="bg-sand rounded-xl p-6 border border-warm-gray/30">
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-charcoal/60">Make & Model</span>
                        <p class="font-semibold text-navy text-lg mt-0.5">{{ $agreement->vehicle->full_name }}</p>
                    </div>
                    <div>
                        <span class="text-charcoal/60">License Plate</span>
                        <p class="font-mono font-semibold text-navy text-lg mt-0.5">{{ $agreement->vehicle->license_plate }}</p>
                    </div>
                    <div>
                        <span class="text-charcoal/60">Color</span>
                        <p class="font-medium text-charcoal mt-0.5">{{ $agreement->vehicle->color }}</p>
                    </div>
                    <div>
                        <span class="text-charcoal/60">Category</span>
                        <p class="font-medium text-charcoal mt-0.5 capitalize">{{ $agreement->vehicle->category }}</p>
                    </div>
                    <div>
                        <span class="text-charcoal/60">Current Mileage</span>
                        <p class="font-medium text-charcoal mt-0.5">{{ number_format($agreement->vehicle->current_mileage) }} km</p>
                    </div>
                    @if($agreement->vehicle->vin)
                    <div>
                        <span class="text-charcoal/60">VIN</span>
                        <p class="font-mono text-xs text-charcoal mt-0.5">{{ $agreement->vehicle->vin }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button wire:click="confirmSection1" class="inline-flex items-center gap-2 bg-teal hover:bg-teal-light text-white px-6 py-3 rounded-lg font-medium transition-colors">
                    I Confirm Vehicle Details
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- Step 2: Rental Period & Rates -->
    @if($currentStep === 2)
    <div class="bg-white rounded-xl shadow-sm border border-warm-gray/30 overflow-hidden">
        <div class="bg-navy px-6 py-4">
            <h2 class="font-serif-display text-xl text-white flex items-center gap-2">
                <i data-lucide="calendar" class="w-5 h-5 text-teal"></i>
                Step 2: Rental Period & Rates
            </h2>
        </div>
        <div class="p-6">
            <p class="text-sm text-charcoal/60 mb-6">Review your rental dates, rates, and costs. All amounts are in US dollars.</p>

            <div class="bg-sand rounded-xl p-6 border border-warm-gray/30 space-y-4">
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-charcoal/60">Pickup Date</span>
                        <p class="font-medium text-charcoal mt-0.5">{{ $agreement->pickup_date->format('l, M d, Y') }}</p>
                    </div>
                    <div>
                        <span class="text-charcoal/60">Return Date</span>
                        <p class="font-medium text-charcoal mt-0.5">{{ $agreement->return_date->format('l, M d, Y') }}</p>
                    </div>
                </div>

                <div class="border-t border-warm-gray/30 pt-4 space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Daily Rate</span>
                        <span class="font-medium text-charcoal">${{ number_format($agreement->daily_rate, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Duration</span>
                        <span class="font-medium text-charcoal">{{ $agreement->rental_days }} days</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Rental Total</span>
                        <span class="font-medium text-charcoal">${{ number_format($agreement->total_cost, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Insurance ({{ ucfirst($agreement->insurance_option) }} CDW)</span>
                        <span class="font-medium text-charcoal">${{ number_format($agreement->insurance_cost, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Security Deposit</span>
                        <span class="font-medium text-charcoal">${{ number_format($agreement->deposit_amount, 2) }}</span>
                    </div>
                    <div class="flex justify-between pt-3 border-t border-warm-gray/30">
                        <span class="font-bold text-navy">Total Due</span>
                        <span class="font-bold text-navy text-xl">${{ number_format($agreement->total_cost + $agreement->insurance_cost, 2) }}</span>
                    </div>
                    <p class="text-xs text-charcoal/40">* Security deposit of ${{ number_format($agreement->deposit_amount, 2) }} will be held and returned upon vehicle return in agreed condition.</p>
                </div>
            </div>

            <div class="mt-6 flex justify-between">
                <button wire:click="goToStep(1)" class="inline-flex items-center gap-2 text-charcoal/50 hover:text-charcoal px-4 py-3 rounded-lg font-medium transition-colors">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Previous
                </button>
                <button wire:click="confirmSection2" class="inline-flex items-center gap-2 bg-teal hover:bg-teal-light text-white px-6 py-3 rounded-lg font-medium transition-colors">
                    I Confirm Rates & Period
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- Step 3: General Rules -->
    @if($currentStep === 3)
    <div class="bg-white rounded-xl shadow-sm border border-warm-gray/30 overflow-hidden">
        <div class="bg-navy px-6 py-4">
            <h2 class="font-serif-display text-xl text-white flex items-center gap-2">
                <i data-lucide="book-open" class="w-5 h-5 text-teal"></i>
                Step 3: General Rules
            </h2>
        </div>
        <div class="p-6">
            <div class="bg-sand rounded-xl p-6 border border-warm-gray/30 max-h-80 overflow-y-auto text-sm text-charcoal/80 leading-relaxed space-y-4 mb-6">
                <h3 class="font-bold text-navy">Rules of the Road in Curacao</h3>
                <ol class="list-decimal list-inside space-y-2">
                    <li><strong>Traffic Direction:</strong> Vehicles drive on the right side of the road in Curacao.</li>
                    <li><strong>Speed Limits:</strong> The speed limit is 40 km/h in urban areas, 60 km/h outside urban areas, and 80 km/h on highways, unless otherwise posted.</li>
                    <li><strong>Seat Belts:</strong> All occupants must wear seat belts at all times.</li>
                    <li><strong>Mobile Phones:</strong> Use of handheld mobile phones while driving is prohibited.</li>
                    <li><strong>Fuel Policy:</strong> The vehicle is provided with a full tank of fuel and must be returned with a full tank. Failure to return with a full tank will result in a refueling charge at prevailing rates plus a service fee of $15.</li>
                    <li><strong>Off-Road Use:</strong> The vehicle must not be driven off paved roads or on unpaved surfaces. Any damage resulting from off-road use is the renter's full responsibility regardless of insurance coverage.</li>
                    <li><strong>Parking:</strong> The renter is responsible for all parking fines, traffic violations, and toll charges incurred during the rental period.</li>
                    <li><strong>Breakdowns:</strong> In case of breakdown, contact CuraRent immediately at +599 9 461 2345. Do not attempt unauthorized repairs.</li>
                    <li><strong>Accidents:</strong> In case of an accident, notify the police and CuraRent immediately. Do not admit fault or liability at the scene.</li>
                    <li><strong>Hours of Operation:</strong> Vehicle pickup and return must be during CuraRent's operating hours unless prior arrangements have been made.</li>
                </ol>
            </div>

            <div class="space-y-4">
                <label class="flex items-start gap-3 cursor-pointer">
                    <input type="checkbox" wire:model.live="rulesRead" class="mt-1 w-4 h-4 rounded border-warm-gray text-teal focus:ring-teal/20">
                    <span class="text-sm text-charcoal">I have read and understand the General Rules of CuraRent and agree to comply with all rules during my rental period.</span>
                </label>
                @error('rulesRead') <p class="text-sm text-terracotta">{{ $message }}</p> @enderror

                <div class="flex items-end gap-4">
                    <div class="flex-1 max-w-[200px]">
                        <label class="block text-sm font-medium text-charcoal mb-1">Your Initials <span class="text-terracotta">*</span></label>
                        <input type="text" wire:model="section3Initials" placeholder="e.g. SJ" maxlength="10" class="w-full px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all font-mono text-lg text-center tracking-wider uppercase">
                    </div>
                </div>
                @error('section3Initials') <p class="text-sm text-terracotta">{{ $message }}</p> @enderror
            </div>

            <div class="mt-6 flex justify-between">
                <button wire:click="goToStep(2)" class="inline-flex items-center gap-2 text-charcoal/50 hover:text-charcoal px-4 py-3 rounded-lg font-medium transition-colors">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Previous
                </button>
                <button wire:click="confirmSection3" class="inline-flex items-center gap-2 bg-teal hover:bg-teal-light text-white px-6 py-3 rounded-lg font-medium transition-colors">
                    Acknowledge & Continue
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- Step 4: Damage & Liability -->
    @if($currentStep === 4)
    <div class="bg-white rounded-xl shadow-sm border border-warm-gray/30 overflow-hidden">
        <div class="bg-navy px-6 py-4">
            <h2 class="font-serif-display text-xl text-white flex items-center gap-2">
                <i data-lucide="shield-alert" class="w-5 h-5 text-teal"></i>
                Step 4: Damage & Liability
            </h2>
        </div>
        <div class="p-6">
            <div class="bg-sand rounded-xl p-6 border border-warm-gray/30 text-sm text-charcoal/80 leading-relaxed space-y-4 mb-6">
                <h3 class="font-bold text-navy">Pre-Existing Damage</h3>
                @if($agreement->damageRecords->count())
                    <p>The following pre-existing damage has been recorded on this vehicle:</p>
                    <div class="space-y-3">
                        @foreach($agreement->damageRecords as $damage)
                        <div class="flex items-start gap-3 bg-white rounded-lg p-3">
                            @if($damage->photo)
                            <img src="{{ Storage::url($damage->photo) }}" alt="Damage" class="w-16 h-16 object-cover rounded">
                            @endif
                            <div>
                                <p class="font-medium text-charcoal">{{ $damage->location_on_vehicle }}</p>
                                <p class="text-charcoal/60">{{ $damage->description }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-teal-dark font-medium">No pre-existing damage has been recorded on this vehicle.</p>
                @endif

                <h3 class="font-bold text-navy pt-4">Liability Terms</h3>
                <ul class="list-disc list-inside space-y-2">
                    <li>The renter is responsible for any new damage to the vehicle during the rental period that is not covered by the selected insurance option.</li>
                    <li><strong>Basic CDW:</strong> Covers collision damage with a deductible of $500. Does not cover tires, glass, undercarriage, or interior damage.</li>
                    <li><strong>Premium CDW:</strong> Full coverage with $0 deductible. Includes tires, glass, and windshield. Does not cover intentional damage or damage from prohibited use.</li>
                    <li><strong>No Insurance:</strong> The renter assumes full liability for all damage, including theft, up to the full replacement value of the vehicle.</li>
                    <li>Your selected insurance: <strong class="text-navy">{{ ucfirst($agreement->insurance_option) }} CDW</strong></li>
                </ul>
            </div>

            <div class="flex items-end gap-4">
                <div class="flex-1 max-w-[200px]">
                    <label class="block text-sm font-medium text-charcoal mb-1">Your Initials <span class="text-terracotta">*</span></label>
                    <input type="text" wire:model="section4Initials" placeholder="e.g. SJ" maxlength="10" class="w-full px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all font-mono text-lg text-center tracking-wider uppercase">
                </div>
            </div>
            @error('section4Initials') <p class="text-sm text-terracotta mt-2">{{ $message }}</p> @enderror

            <div class="mt-6 flex justify-between">
                <button wire:click="goToStep(3)" class="inline-flex items-center gap-2 text-charcoal/50 hover:text-charcoal px-4 py-3 rounded-lg font-medium transition-colors">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Previous
                </button>
                <button wire:click="confirmSection4" class="inline-flex items-center gap-2 bg-teal hover:bg-teal-light text-white px-6 py-3 rounded-lg font-medium transition-colors">
                    Acknowledge & Continue
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- Step 5: Fuel & Mileage Policy -->
    @if($currentStep === 5)
    <div class="bg-white rounded-xl shadow-sm border border-warm-gray/30 overflow-hidden">
        <div class="bg-navy px-6 py-4">
            <h2 class="font-serif-display text-xl text-white flex items-center gap-2">
                <i data-lucide="fuel" class="w-5 h-5 text-teal"></i>
                Step 5: Fuel & Mileage Policy
            </h2>
        </div>
        <div class="p-6">
            <div class="bg-sand rounded-xl p-6 border border-warm-gray/30 text-sm text-charcoal/80 leading-relaxed space-y-4 mb-6">
                <h3 class="font-bold text-navy">Fuel Policy: Full-to-Full</h3>
                <ul class="list-disc list-inside space-y-2">
                    <li>The vehicle is provided with a <strong>full tank of fuel</strong>.</li>
                    <li>The vehicle must be returned with a <strong>full tank of fuel</strong>.</li>
                    <li>If the vehicle is returned with less than a full tank, CuraRent will refuel the vehicle and charge the prevailing pump rate plus a <strong>$15.00 service fee</strong>.</li>
                    <li>Fuel type for your vehicle: <strong>Unleaded gasoline</strong>. Using incorrect fuel will void all insurance coverage.</li>
                    <li>Several gas stations are located on the main routes. Most accept credit cards. We recommend refueling before returning the vehicle.</li>
                </ul>

                <h3 class="font-bold text-navy pt-4">Mileage Policy</h3>
                <ul class="list-disc list-inside space-y-2">
                    <li>Your rental includes <strong>unlimited mileage</strong>.</li>
                    <li>There are no additional per-kilometer charges.</li>
                    <li>Current odometer reading at pickup: <strong>{{ number_format($agreement->vehicle->current_mileage) }} km</strong></li>
                </ul>
            </div>

            <div class="flex items-end gap-4">
                <div class="flex-1 max-w-[200px]">
                    <label class="block text-sm font-medium text-charcoal mb-1">Your Initials <span class="text-terracotta">*</span></label>
                    <input type="text" wire:model="section5Initials" placeholder="e.g. SJ" maxlength="10" class="w-full px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all font-mono text-lg text-center tracking-wider uppercase">
                </div>
            </div>
            @error('section5Initials') <p class="text-sm text-terracotta mt-2">{{ $message }}</p> @enderror

            <div class="mt-6 flex justify-between">
                <button wire:click="goToStep(4)" class="inline-flex items-center gap-2 text-charcoal/50 hover:text-charcoal px-4 py-3 rounded-lg font-medium transition-colors">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Previous
                </button>
                <button wire:click="confirmSection5" class="inline-flex items-center gap-2 bg-teal hover:bg-teal-light text-white px-6 py-3 rounded-lg font-medium transition-colors">
                    Acknowledge & Continue
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- Step 6: Prohibited Uses -->
    @if($currentStep === 6)
    <div class="bg-white rounded-xl shadow-sm border border-warm-gray/30 overflow-hidden">
        <div class="bg-navy px-6 py-4">
            <h2 class="font-serif-display text-xl text-white flex items-center gap-2">
                <i data-lucide="ban" class="w-5 h-5 text-teal"></i>
                Step 6: Prohibited Uses
            </h2>
        </div>
        <div class="p-6">
            <div class="bg-sand rounded-xl p-6 border border-warm-gray/30 text-sm text-charcoal/80 leading-relaxed space-y-4 mb-6">
                <h3 class="font-bold text-navy">The following uses of the rental vehicle are strictly prohibited:</h3>
                <ul class="list-disc list-inside space-y-2">
                    <li><strong>Subletting:</strong> The vehicle may not be sublet, rented, loaned, or transferred to any third party.</li>
                    <li><strong>Racing or Competitions:</strong> The vehicle may not be used for any form of racing, speed testing, or driving competitions.</li>
                    <li><strong>Towing:</strong> The vehicle may not be used to tow or push any other vehicle, trailer, or object.</li>
                    <li><strong>Driving Under Influence:</strong> Operating the vehicle while under the influence of alcohol, drugs, or any intoxicating substance is strictly prohibited and voids all insurance coverage.</li>
                    <li><strong>Geographic Restrictions:</strong> The vehicle is restricted to the island of Curacao only. The vehicle may not be transported off the island by any means.</li>
                    <li><strong>Off-Road Use:</strong> The vehicle must remain on paved roads at all times. Off-road driving, beach driving, or driving on unpaved surfaces is prohibited.</li>
                    <li><strong>Commercial Use:</strong> The vehicle is for personal transportation only and may not be used for commercial purposes, ride-sharing, or delivery services.</li>
                    <li><strong>Overloading:</strong> The vehicle must not carry more passengers or cargo than the manufacturer's recommended capacity.</li>
                </ul>
                <p class="text-terracotta font-medium pt-2">Violation of any prohibited use will void all insurance coverage and the renter will assume full liability for any resulting damage, loss, or legal consequences.</p>
            </div>

            <div class="flex items-end gap-4">
                <div class="flex-1 max-w-[200px]">
                    <label class="block text-sm font-medium text-charcoal mb-1">Your Initials <span class="text-terracotta">*</span></label>
                    <input type="text" wire:model="section6Initials" placeholder="e.g. SJ" maxlength="10" class="w-full px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all font-mono text-lg text-center tracking-wider uppercase">
                </div>
            </div>
            @error('section6Initials') <p class="text-sm text-terracotta mt-2">{{ $message }}</p> @enderror

            <div class="mt-6 flex justify-between">
                <button wire:click="goToStep(5)" class="inline-flex items-center gap-2 text-charcoal/50 hover:text-charcoal px-4 py-3 rounded-lg font-medium transition-colors">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Previous
                </button>
                <button wire:click="confirmSection6" class="inline-flex items-center gap-2 bg-teal hover:bg-teal-light text-white px-6 py-3 rounded-lg font-medium transition-colors">
                    Acknowledge & Continue
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- Step 7: Additional Drivers -->
    @if($currentStep === 7)
    <div class="bg-white rounded-xl shadow-sm border border-warm-gray/30 overflow-hidden">
        <div class="bg-navy px-6 py-4">
            <h2 class="font-serif-display text-xl text-white flex items-center gap-2">
                <i data-lucide="users" class="w-5 h-5 text-teal"></i>
                Step 7: Additional Drivers
            </h2>
        </div>
        <div class="p-6">
            <p class="text-sm text-charcoal/60 mb-6">Only authorized drivers listed on this agreement may operate the vehicle. Add any additional drivers below, or confirm you will be the sole driver.</p>

            <!-- Sole Driver Checkbox -->
            <label class="flex items-center gap-3 mb-6 cursor-pointer">
                <input type="checkbox" wire:model.live="soleDriver" class="w-4 h-4 rounded border-warm-gray text-teal focus:ring-teal/20">
                <span class="text-sm font-medium text-charcoal">I will be the sole driver of this vehicle</span>
            </label>

            @if(!$soleDriver)
            <!-- Add Driver Form -->
            <div class="bg-sand rounded-xl p-5 border border-warm-gray/30 mb-4">
                <h4 class="font-medium text-charcoal text-sm mb-3">Add Additional Driver</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <input type="text" wire:model="newDriverName" placeholder="Full name" class="w-full px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all text-sm">
                        @error('newDriverName') <p class="text-xs text-terracotta mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="flex gap-2">
                        <input type="text" wire:model="newDriverLicense" placeholder="License number" class="flex-1 px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all text-sm">
                        <button wire:click="addDriver" type="button" class="inline-flex items-center gap-1 bg-navy hover:bg-navy-light text-white px-4 py-2.5 rounded-lg text-sm font-medium transition-colors">
                            <i data-lucide="plus" class="w-4 h-4"></i>
                            Add
                        </button>
                    </div>
                    @error('newDriverLicense') <p class="text-xs text-terracotta mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Listed Drivers -->
            @if(count($additionalDrivers))
            <div class="space-y-2 mb-4">
                @foreach($additionalDrivers as $index => $driver)
                <div class="flex items-center justify-between bg-white border border-warm-gray/30 rounded-lg px-4 py-3">
                    <div>
                        <p class="font-medium text-charcoal text-sm">{{ $driver['name'] }}</p>
                        <p class="text-xs text-charcoal/50">License: {{ $driver['license_number'] }}</p>
                    </div>
                    <button wire:click="removeDriver({{ $index }})" type="button" class="text-terracotta hover:text-terracotta-dark transition-colors">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>
                @endforeach
            </div>
            @endif
            @endif

            @error('drivers') <p class="text-sm text-terracotta mb-4">{{ $message }}</p> @enderror

            <div class="flex items-end gap-4 mt-4">
                <div class="flex-1 max-w-[200px]">
                    <label class="block text-sm font-medium text-charcoal mb-1">Your Initials <span class="text-terracotta">*</span></label>
                    <input type="text" wire:model="section7Initials" placeholder="e.g. SJ" maxlength="10" class="w-full px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all font-mono text-lg text-center tracking-wider uppercase">
                </div>
            </div>
            @error('section7Initials') <p class="text-sm text-terracotta mt-2">{{ $message }}</p> @enderror

            <div class="mt-6 flex justify-between">
                <button wire:click="goToStep(6)" class="inline-flex items-center gap-2 text-charcoal/50 hover:text-charcoal px-4 py-3 rounded-lg font-medium transition-colors">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Previous
                </button>
                <button wire:click="confirmSection7" class="inline-flex items-center gap-2 bg-teal hover:bg-teal-light text-white px-6 py-3 rounded-lg font-medium transition-colors">
                    Acknowledge & Continue
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- Step 8: Final Signature -->
    @if($currentStep === 8)
    <div class="bg-white rounded-xl shadow-sm border border-warm-gray/30 overflow-hidden">
        <div class="bg-navy px-6 py-4">
            <h2 class="font-serif-display text-xl text-white flex items-center gap-2">
                <i data-lucide="pen-tool" class="w-5 h-5 text-teal"></i>
                Step 8: Sign Agreement
            </h2>
        </div>
        <div class="p-6">
            <p class="text-sm text-charcoal/60 mb-6">Review the completed sections below. By signing, you agree to all terms and conditions of this rental agreement.</p>

            <!-- Section Summary -->
            <div class="bg-sand rounded-xl p-5 border border-warm-gray/30 mb-6 space-y-2">
                @php
                    $sections = [
                        1 => 'Vehicle Information',
                        2 => 'Rental Period & Rates',
                        3 => 'General Rules',
                        4 => 'Damage & Liability',
                        5 => 'Fuel & Mileage Policy',
                        6 => 'Prohibited Uses',
                        7 => 'Additional Drivers',
                    ];
                @endphp
                @foreach($sections as $num => $name)
                <div class="flex items-center gap-3 text-sm">
                    @if($agreement->{"section_{$num}_confirmed"})
                        <i data-lucide="check-circle" class="w-5 h-5 text-teal flex-shrink-0"></i>
                        <span class="text-charcoal">{{ $name }}</span>
                        @if($num >= 3 && $num <= 7 && $agreement->{"section_{$num}_initials"})
                            <span class="font-mono text-xs bg-white px-2 py-0.5 rounded border border-warm-gray/30 text-charcoal/60">{{ $agreement->{"section_{$num}_initials"} }}</span>
                        @endif
                    @else
                        <i data-lucide="circle" class="w-5 h-5 text-charcoal/20 flex-shrink-0"></i>
                        <span class="text-charcoal/40">{{ $name }}</span>
                    @endif
                </div>
                @endforeach
            </div>

            <!-- Signature Pad -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-charcoal mb-3">Your Signature <span class="text-terracotta">*</span></label>
                <div
                    x-data="{
                        canvas: null,
                        ctx: null,
                        isDrawing: false,
                        hasDrawn: false,
                        lastX: 0,
                        lastY: 0,
                        init() {
                            this.canvas = this.$refs.signatureCanvas;
                            this.ctx = this.canvas.getContext('2d');
                            this.ctx.strokeStyle = '#1C3557';
                            this.ctx.lineWidth = 2;
                            this.ctx.lineCap = 'round';
                            this.ctx.lineJoin = 'round';
                            this.clearCanvas();
                        },
                        startDrawing(e) {
                            this.isDrawing = true;
                            this.hasDrawn = true;
                            [this.lastX, this.lastY] = this.getPos(e);
                        },
                        draw(e) {
                            if (!this.isDrawing) return;
                            const [x, y] = this.getPos(e);
                            this.ctx.beginPath();
                            this.ctx.moveTo(this.lastX, this.lastY);
                            this.ctx.lineTo(x, y);
                            this.ctx.stroke();
                            [this.lastX, this.lastY] = [x, y];
                        },
                        stopDrawing() {
                            if (this.isDrawing) {
                                this.isDrawing = false;
                                this.save();
                            }
                        },
                        getPos(e) {
                            const rect = this.canvas.getBoundingClientRect();
                            const scaleX = this.canvas.width / rect.width;
                            const scaleY = this.canvas.height / rect.height;
                            const clientX = e.touches ? e.touches[0].clientX : e.clientX;
                            const clientY = e.touches ? e.touches[0].clientY : e.clientY;
                            return [(clientX - rect.left) * scaleX, (clientY - rect.top) * scaleY];
                        },
                        clearCanvas() {
                            this.ctx.fillStyle = '#ffffff';
                            this.ctx.fillRect(0, 0, this.canvas.width, this.canvas.height);
                            this.hasDrawn = false;
                            @this.set('signature', null);
                        },
                        save() {
                            @this.set('signature', this.canvas.toDataURL('image/png'));
                        }
                    }"
                    class="inline-block w-full"
                >
                    <div class="border-2 border-dashed border-warm-gray rounded-xl overflow-hidden bg-white">
                        <canvas
                            x-ref="signatureCanvas"
                            width="700"
                            height="200"
                            @mousedown="startDrawing($event)"
                            @mousemove="draw($event)"
                            @mouseup="stopDrawing()"
                            @mouseleave="stopDrawing()"
                            @touchstart.prevent="startDrawing($event)"
                            @touchmove.prevent="draw($event)"
                            @touchend="stopDrawing()"
                            class="w-full cursor-crosshair"
                            style="touch-action: none;"
                        ></canvas>
                    </div>
                    <div class="flex items-center justify-between mt-2">
                        <p class="text-xs text-charcoal/40">Draw your signature in the box above</p>
                        <button type="button" @click="clearCanvas()" class="text-sm text-charcoal/50 hover:text-charcoal transition-colors flex items-center gap-1">
                            <i data-lucide="eraser" class="w-3.5 h-3.5"></i>
                            Clear
                        </button>
                    </div>
                </div>
                @error('signature') <p class="text-sm text-terracotta mt-2">{{ $message }}</p> @enderror
            </div>

            <!-- Legal Notice -->
            <div class="bg-parchment-dark rounded-lg p-4 mb-6 border border-warm-gray/30">
                <p class="text-xs text-charcoal/60 leading-relaxed">
                    By signing above, I, <strong>{{ $agreement->registration->full_name }}</strong>, acknowledge that I have read, understood, and agree to all terms and conditions of this rental agreement
                    (<strong>{{ $agreement->agreement_number }}</strong>) for the vehicle <strong>{{ $agreement->vehicle->full_name }}</strong> ({{ $agreement->vehicle->license_plate }})
                    for the period of {{ $agreement->pickup_date->format('M d, Y') }} to {{ $agreement->return_date->format('M d, Y') }}.
                </p>
            </div>

            <div class="mt-6 flex justify-between">
                <button wire:click="goToStep(7)" class="inline-flex items-center gap-2 text-charcoal/50 hover:text-charcoal px-4 py-3 rounded-lg font-medium transition-colors">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Previous
                </button>
                <button wire:click="signAgreement" class="inline-flex items-center gap-2 bg-terracotta hover:bg-terracotta-dark text-white px-8 py-3 rounded-lg font-bold transition-colors shadow-lg shadow-terracotta/25 text-lg">
                    <i data-lucide="pen-tool" class="w-5 h-5"></i>
                    Sign & Complete
                </button>
            </div>
        </div>
    </div>
    @endif
</div>
