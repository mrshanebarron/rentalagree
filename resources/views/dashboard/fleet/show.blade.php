<x-layouts.dashboard title="{{ $vehicle->full_name }}" header="Vehicle Details">
    <div class="max-w-4xl">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h2 class="font-display text-2xl font-bold text-navy">{{ $vehicle->full_name }}</h2>
                <p class="text-sm text-charcoal/50">{{ $vehicle->license_plate }} &bull; {{ $vehicle->color }}</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('dashboard.fleet.edit', $vehicle) }}" class="inline-flex items-center gap-2 bg-navy hover:bg-navy-light text-white px-5 py-2.5 rounded-lg text-sm font-medium transition-colors">
                    <i data-lucide="pencil" class="w-4 h-4"></i>
                    Edit
                </a>
                <form method="POST" action="{{ route('dashboard.fleet.destroy', $vehicle) }}" onsubmit="return confirm('Delete this vehicle?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-2 bg-terracotta/10 hover:bg-terracotta/20 text-terracotta px-5 py-2.5 rounded-lg text-sm font-medium transition-colors">
                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                        Delete
                    </button>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Vehicle Photo -->
            <div class="bg-white rounded-xl border border-warm-gray/30 overflow-hidden">
                <div class="aspect-[4/3] bg-sand">
                    @if($vehicle->photo)
                        <img src="{{ Storage::url($vehicle->photo) }}" alt="{{ $vehicle->full_name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <i data-lucide="car" class="w-20 h-20 text-charcoal/10"></i>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Vehicle Info -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-xl border border-warm-gray/30 overflow-hidden">
                    <div class="bg-parchment px-5 py-3 border-b border-warm-gray/30">
                        <h3 class="font-serif-display text-base text-navy">Details</h3>
                    </div>
                    <div class="px-5 py-4 grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-charcoal/60">Category</span>
                            <p class="font-medium text-charcoal capitalize mt-0.5">{{ $vehicle->category }}</p>
                        </div>
                        <div>
                            <span class="text-charcoal/60">Daily Rate</span>
                            <p class="font-bold text-navy mt-0.5">${{ number_format($vehicle->daily_rate, 2) }}</p>
                        </div>
                        <div>
                            <span class="text-charcoal/60">Status</span>
                            @php
                                $statusColors = ['available' => 'bg-green-100 text-green-800', 'rented' => 'bg-blue-100 text-blue-800', 'maintenance' => 'bg-yellow-100 text-yellow-800'];
                            @endphp
                            <p class="mt-0.5"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$vehicle->status] }} capitalize">{{ $vehicle->status }}</span></p>
                        </div>
                        <div>
                            <span class="text-charcoal/60">Mileage</span>
                            <p class="font-medium text-charcoal mt-0.5">{{ number_format($vehicle->current_mileage) }} km</p>
                        </div>
                        @if($vehicle->vin)
                        <div class="col-span-2">
                            <span class="text-charcoal/60">VIN</span>
                            <p class="font-medium text-charcoal mt-0.5 font-mono text-xs">{{ $vehicle->vin }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Rental History -->
        <div class="mt-6 bg-white rounded-xl border border-warm-gray/30 overflow-hidden">
            <div class="px-5 py-3 border-b border-warm-gray/30">
                <h3 class="font-serif-display text-base text-navy">Rental History</h3>
            </div>
            @if($vehicle->agreements->count())
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-sand">
                        <tr>
                            <th class="text-left px-5 py-3 text-xs font-medium text-charcoal/60 uppercase tracking-wider">Agreement</th>
                            <th class="text-left px-5 py-3 text-xs font-medium text-charcoal/60 uppercase tracking-wider">Customer</th>
                            <th class="text-left px-5 py-3 text-xs font-medium text-charcoal/60 uppercase tracking-wider">Dates</th>
                            <th class="text-left px-5 py-3 text-xs font-medium text-charcoal/60 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-warm-gray/30">
                        @foreach($vehicle->agreements as $agreement)
                        <tr class="hover:bg-sand/50 transition-colors">
                            <td class="px-5 py-3">
                                <a href="{{ route('dashboard.agreements.show', $agreement) }}" class="font-mono text-sm font-semibold text-teal hover:text-teal-dark">{{ $agreement->agreement_number }}</a>
                            </td>
                            <td class="px-5 py-3 text-sm">{{ $agreement->registration->full_name }}</td>
                            <td class="px-5 py-3 text-sm text-charcoal/70">{{ $agreement->pickup_date->format('M d') }} - {{ $agreement->return_date->format('M d, Y') }}</td>
                            <td class="px-5 py-3">
                                @php
                                    $aColors = ['draft' => 'bg-gray-100 text-gray-700', 'in_progress' => 'bg-blue-100 text-blue-800', 'signed' => 'bg-green-100 text-green-800', 'expired' => 'bg-red-100 text-red-800'];
                                @endphp
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $aColors[$agreement->status] }}">{{ ucfirst($agreement->status) }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="px-5 py-8 text-center text-charcoal/40 text-sm">No rental history for this vehicle.</div>
            @endif
        </div>

        <div class="mt-6">
            <a href="{{ route('dashboard.fleet.index') }}" class="inline-flex items-center gap-1 text-sm text-charcoal/50 hover:text-charcoal transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back to Fleet
            </a>
        </div>
    </div>
</x-layouts.dashboard>
