<x-layouts.dashboard title="Agreement {{ $agreement->agreement_number }}" header="Agreement Details">
    <div class="max-w-4xl">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <div class="flex items-center gap-3 mb-1">
                    <span class="font-mono text-lg font-bold text-navy">{{ $agreement->agreement_number }}</span>
                    @php
                        $colors = ['draft' => 'bg-gray-100 text-gray-700', 'in_progress' => 'bg-blue-100 text-blue-800', 'signed' => 'bg-green-100 text-green-800', 'expired' => 'bg-red-100 text-red-800'];
                    @endphp
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $colors[$agreement->status] }}">
                        {{ str_replace('_', ' ', ucfirst($agreement->status)) }}
                    </span>
                </div>
                <p class="text-sm text-charcoal/50">Created by {{ $agreement->user->name }} on {{ $agreement->created_at->format('M d, Y') }}</p>
            </div>
            <div class="flex gap-3">
                @if($agreement->status === 'in_progress')
                    @php
                        $signUrl = URL::signedRoute('agreements.sign', ['agreement' => $agreement->id]);
                    @endphp
                    <div x-data="{ copied: false }" class="flex gap-2">
                        <button @click="navigator.clipboard.writeText('{{ $signUrl }}'); copied = true; setTimeout(() => copied = false, 2000)" class="inline-flex items-center gap-2 bg-navy hover:bg-navy-light text-white px-4 py-2.5 rounded-lg text-sm font-medium transition-colors">
                            <i data-lucide="copy" class="w-4 h-4"></i>
                            <span x-text="copied ? 'Copied!' : 'Copy Sign Link'"></span>
                        </button>
                    </div>
                @endif
                @if($agreement->status === 'signed')
                    <a href="{{ route('dashboard.agreements.pdf', $agreement) }}" class="inline-flex items-center gap-2 bg-navy hover:bg-navy-light text-white px-5 py-2.5 rounded-lg text-sm font-medium transition-colors">
                        <i data-lucide="download" class="w-4 h-4"></i>
                        Download PDF
                    </a>
                @endif
            </div>
        </div>

        @if(session('sign_url'))
        <div class="mb-6 bg-teal/5 border border-teal/20 rounded-xl p-5">
            <h3 class="font-medium text-teal-dark text-sm mb-2 flex items-center gap-2">
                <i data-lucide="link" class="w-4 h-4"></i>
                Customer Signing Link
            </h3>
            <div class="bg-white rounded-lg p-3 border border-teal/10" x-data="{ copied: false }">
                <div class="flex items-center gap-2">
                    <code class="text-xs text-charcoal/70 flex-1 break-all">{{ session('sign_url') }}</code>
                    <button @click="navigator.clipboard.writeText('{{ session('sign_url') }}'); copied = true; setTimeout(() => copied = false, 2000)" class="text-teal hover:text-teal-dark flex-shrink-0">
                        <i data-lucide="copy" class="w-4 h-4"></i>
                    </button>
                </div>
                <p x-show="copied" x-transition class="text-xs text-teal mt-1">Copied to clipboard</p>
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Customer Info -->
            <div class="bg-white rounded-xl border border-warm-gray/30 overflow-hidden">
                <div class="bg-parchment px-5 py-3 border-b border-warm-gray/30">
                    <h3 class="font-serif-display text-base text-navy flex items-center gap-2">
                        <i data-lucide="user" class="w-4 h-4 text-teal"></i>
                        Customer
                    </h3>
                </div>
                <div class="px-5 py-4 space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Name</span>
                        <span class="font-medium text-charcoal">{{ $agreement->registration->full_name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Email</span>
                        <span class="font-medium text-charcoal">{{ $agreement->registration->email }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Phone</span>
                        <span class="font-medium text-charcoal">{{ $agreement->registration->phone }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">License</span>
                        <span class="font-medium text-charcoal">{{ $agreement->registration->license_number }}</span>
                    </div>
                </div>
            </div>

            <!-- Vehicle Info -->
            <div class="bg-white rounded-xl border border-warm-gray/30 overflow-hidden">
                <div class="bg-parchment px-5 py-3 border-b border-warm-gray/30">
                    <h3 class="font-serif-display text-base text-navy flex items-center gap-2">
                        <i data-lucide="car" class="w-4 h-4 text-teal"></i>
                        Vehicle
                    </h3>
                </div>
                <div class="px-5 py-4 space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Vehicle</span>
                        <span class="font-medium text-charcoal">{{ $agreement->vehicle->full_name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Plate</span>
                        <span class="font-medium text-charcoal">{{ $agreement->vehicle->license_plate }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Color</span>
                        <span class="font-medium text-charcoal">{{ $agreement->vehicle->color }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Category</span>
                        <span class="font-medium text-charcoal capitalize">{{ $agreement->vehicle->category }}</span>
                    </div>
                </div>
            </div>

            <!-- Rental Period & Cost -->
            <div class="bg-white rounded-xl border border-warm-gray/30 overflow-hidden">
                <div class="bg-parchment px-5 py-3 border-b border-warm-gray/30">
                    <h3 class="font-serif-display text-base text-navy flex items-center gap-2">
                        <i data-lucide="calendar" class="w-4 h-4 text-teal"></i>
                        Rental Period
                    </h3>
                </div>
                <div class="px-5 py-4 space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Pickup</span>
                        <span class="font-medium text-charcoal">{{ $agreement->pickup_date->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Return</span>
                        <span class="font-medium text-charcoal">{{ $agreement->return_date->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Duration</span>
                        <span class="font-medium text-charcoal">{{ $agreement->rental_days }} days</span>
                    </div>
                </div>
            </div>

            <!-- Cost -->
            <div class="bg-white rounded-xl border border-warm-gray/30 overflow-hidden">
                <div class="bg-parchment px-5 py-3 border-b border-warm-gray/30">
                    <h3 class="font-serif-display text-base text-navy flex items-center gap-2">
                        <i data-lucide="receipt" class="w-4 h-4 text-teal"></i>
                        Cost Breakdown
                    </h3>
                </div>
                <div class="px-5 py-4 space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Daily Rate</span>
                        <span class="font-medium text-charcoal">${{ number_format($agreement->daily_rate, 2) }}/day</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Rental Cost</span>
                        <span class="font-medium text-charcoal">${{ number_format($agreement->total_cost, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Insurance ({{ ucfirst($agreement->insurance_option) }})</span>
                        <span class="font-medium text-charcoal">${{ number_format($agreement->insurance_cost, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-charcoal/60">Deposit</span>
                        <span class="font-medium text-charcoal">${{ number_format($agreement->deposit_amount, 2) }}</span>
                    </div>
                    <div class="flex justify-between pt-3 border-t border-warm-gray/30">
                        <span class="font-semibold text-navy">Total</span>
                        <span class="font-bold text-navy text-lg">${{ number_format($agreement->total_cost + $agreement->insurance_cost, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Signing Progress -->
        <div class="mt-6 bg-white rounded-xl border border-warm-gray/30 overflow-hidden">
            <div class="px-5 py-3 border-b border-warm-gray/30">
                <h3 class="font-serif-display text-base text-navy">Agreement Progress</h3>
            </div>
            <div class="px-5 py-4">
                <div class="flex gap-2 mb-4">
                    @for($i = 1; $i <= 8; $i++)
                        @php
                            $completed = $i <= 7 ? $agreement->{"section_{$i}_confirmed"} : ($agreement->signature !== null);
                        @endphp
                        <div class="flex-1 h-2 rounded-full {{ $completed ? 'bg-teal' : 'bg-warm-gray/30' }}"></div>
                    @endfor
                </div>
                <p class="text-sm text-charcoal/50">Step {{ $agreement->current_step }} of 8 &bull; {{ $agreement->completed_sections }} sections completed</p>

                @if($agreement->signed_at)
                <div class="mt-4 pt-4 border-t border-warm-gray/30 flex items-center gap-3">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                        <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i>
                    </div>
                    <div>
                        <p class="font-medium text-green-800 text-sm">Agreement Signed</p>
                        <p class="text-xs text-charcoal/50">{{ $agreement->signed_at->format('M d, Y \a\t g:i A') }}</p>
                    </div>
                </div>
                @endif

                @if($agreement->signature)
                <div class="mt-4 pt-4 border-t border-warm-gray/30">
                    <p class="text-xs text-charcoal/50 mb-2">Signature</p>
                    <img src="{{ $agreement->signature }}" alt="Customer Signature" class="h-20 border border-warm-gray/30 rounded bg-white">
                </div>
                @endif
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('dashboard.agreements.index') }}" class="inline-flex items-center gap-1 text-sm text-charcoal/50 hover:text-charcoal transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back to Agreements
            </a>
        </div>
    </div>
</x-layouts.dashboard>
