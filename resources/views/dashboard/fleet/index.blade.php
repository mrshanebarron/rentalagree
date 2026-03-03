<x-layouts.dashboard title="Fleet" header="Fleet Management">
    <!-- Filters -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <form action="{{ route('dashboard.fleet.index') }}" method="GET" class="flex gap-3">
            <select name="status" onchange="this.form.submit()" class="px-4 py-2 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all bg-white text-sm">
                <option value="">All Statuses</option>
                <option value="available" {{ request('status') === 'available' ? 'selected' : '' }}>Available</option>
                <option value="rented" {{ request('status') === 'rented' ? 'selected' : '' }}>Rented</option>
                <option value="maintenance" {{ request('status') === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
            </select>
            <select name="category" onchange="this.form.submit()" class="px-4 py-2 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all bg-white text-sm">
                <option value="">All Categories</option>
                <option value="economy" {{ request('category') === 'economy' ? 'selected' : '' }}>Economy</option>
                <option value="compact" {{ request('category') === 'compact' ? 'selected' : '' }}>Compact</option>
                <option value="suv" {{ request('category') === 'suv' ? 'selected' : '' }}>SUV</option>
                <option value="luxury" {{ request('category') === 'luxury' ? 'selected' : '' }}>Luxury</option>
            </select>
        </form>
        <a href="{{ route('dashboard.fleet.create') }}" class="inline-flex items-center gap-2 bg-teal hover:bg-teal-light text-white px-5 py-2.5 rounded-lg font-medium transition-colors text-sm">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Add Vehicle
        </a>
    </div>

    <!-- Vehicle Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
        @forelse($vehicles as $vehicle)
        <a href="{{ route('dashboard.fleet.show', $vehicle) }}" class="bg-white rounded-xl border border-warm-gray/30 overflow-hidden hover:shadow-lg transition-all group">
            <div class="aspect-[16/10] bg-sand relative overflow-hidden">
                @if($vehicle->photo)
                    <img src="{{ Storage::url($vehicle->photo) }}" alt="{{ $vehicle->full_name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <i data-lucide="car" class="w-16 h-16 text-charcoal/10"></i>
                    </div>
                @endif
                @php
                    $statusColors = ['available' => 'bg-green-500', 'rented' => 'bg-blue-500', 'maintenance' => 'bg-yellow-500'];
                @endphp
                <div class="absolute top-3 right-3">
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-white/90 backdrop-blur-sm shadow-sm capitalize">
                        <span class="w-2 h-2 rounded-full {{ $statusColors[$vehicle->status] }}"></span>
                        {{ $vehicle->status }}
                    </span>
                </div>
            </div>
            <div class="p-4">
                <div class="flex items-start justify-between mb-1">
                    <h3 class="font-medium text-charcoal text-sm">{{ $vehicle->full_name }}</h3>
                </div>
                <p class="text-xs text-charcoal/50 mb-3">{{ $vehicle->license_plate }} &bull; {{ $vehicle->color }} &bull; <span class="capitalize">{{ $vehicle->category }}</span></p>
                <div class="flex items-center justify-between">
                    <span class="text-lg font-bold text-navy">${{ number_format($vehicle->daily_rate, 0) }}<span class="text-xs font-normal text-charcoal/50">/day</span></span>
                    <span class="text-xs text-charcoal/40">{{ number_format($vehicle->current_mileage) }} km</span>
                </div>
            </div>
        </a>
        @empty
        <div class="col-span-full text-center py-12 text-charcoal/40">
            <i data-lucide="car" class="w-16 h-16 mx-auto mb-3 text-charcoal/15"></i>
            <p>No vehicles found.</p>
        </div>
        @endforelse
    </div>
</x-layouts.dashboard>
