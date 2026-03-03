<x-layouts.dashboard title="Edit {{ $vehicle->full_name }}" header="Edit Vehicle">
    <div class="max-w-2xl">
        <form method="POST" action="{{ route('dashboard.fleet.update', $vehicle) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-xl border border-warm-gray/30 overflow-hidden">
                <div class="bg-parchment px-6 py-4 border-b border-warm-gray/30">
                    <h3 class="font-serif-display text-lg text-navy flex items-center gap-2">
                        <i data-lucide="car" class="w-5 h-5 text-teal"></i>
                        Vehicle Information
                    </h3>
                </div>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Make <span class="text-terracotta">*</span></label>
                        <input type="text" name="make" value="{{ old('make', $vehicle->make) }}" required class="w-full px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all">
                        @error('make') <p class="mt-1 text-sm text-terracotta">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Model <span class="text-terracotta">*</span></label>
                        <input type="text" name="model" value="{{ old('model', $vehicle->model) }}" required class="w-full px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all">
                        @error('model') <p class="mt-1 text-sm text-terracotta">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Year <span class="text-terracotta">*</span></label>
                        <input type="number" name="year" value="{{ old('year', $vehicle->year) }}" required min="2000" max="2030" class="w-full px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all">
                        @error('year') <p class="mt-1 text-sm text-terracotta">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">License Plate <span class="text-terracotta">*</span></label>
                        <input type="text" name="license_plate" value="{{ old('license_plate', $vehicle->license_plate) }}" required class="w-full px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all">
                        @error('license_plate') <p class="mt-1 text-sm text-terracotta">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Color <span class="text-terracotta">*</span></label>
                        <input type="text" name="color" value="{{ old('color', $vehicle->color) }}" required class="w-full px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all">
                        @error('color') <p class="mt-1 text-sm text-terracotta">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">VIN <span class="text-charcoal/40">(optional)</span></label>
                        <input type="text" name="vin" value="{{ old('vin', $vehicle->vin) }}" class="w-full px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all">
                        @error('vin') <p class="mt-1 text-sm text-terracotta">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Category <span class="text-terracotta">*</span></label>
                        <select name="category" required class="w-full px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all bg-white">
                            <option value="economy" {{ old('category', $vehicle->category) === 'economy' ? 'selected' : '' }}>Economy</option>
                            <option value="compact" {{ old('category', $vehicle->category) === 'compact' ? 'selected' : '' }}>Compact</option>
                            <option value="suv" {{ old('category', $vehicle->category) === 'suv' ? 'selected' : '' }}>SUV</option>
                            <option value="luxury" {{ old('category', $vehicle->category) === 'luxury' ? 'selected' : '' }}>Luxury</option>
                        </select>
                        @error('category') <p class="mt-1 text-sm text-terracotta">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Daily Rate (USD) <span class="text-terracotta">*</span></label>
                        <input type="number" name="daily_rate" value="{{ old('daily_rate', $vehicle->daily_rate) }}" required min="0" step="0.01" class="w-full px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all">
                        @error('daily_rate') <p class="mt-1 text-sm text-terracotta">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Status <span class="text-terracotta">*</span></label>
                        <select name="status" required class="w-full px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all bg-white">
                            <option value="available" {{ old('status', $vehicle->status) === 'available' ? 'selected' : '' }}>Available</option>
                            <option value="rented" {{ old('status', $vehicle->status) === 'rented' ? 'selected' : '' }}>Rented</option>
                            <option value="maintenance" {{ old('status', $vehicle->status) === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                        </select>
                        @error('status') <p class="mt-1 text-sm text-terracotta">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Current Mileage (km) <span class="text-terracotta">*</span></label>
                        <input type="number" name="current_mileage" value="{{ old('current_mileage', $vehicle->current_mileage) }}" required min="0" class="w-full px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all">
                        @error('current_mileage') <p class="mt-1 text-sm text-terracotta">{{ $message }}</p> @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-charcoal mb-1">Photo</label>
                        @if($vehicle->photo)
                        <div class="mb-2">
                            <img src="{{ Storage::url($vehicle->photo) }}" alt="Current photo" class="w-32 h-20 object-cover rounded border">
                        </div>
                        @endif
                        <input type="file" name="photo" accept="image/*" class="w-full text-sm text-charcoal file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-navy/5 file:text-navy hover:file:bg-navy/10 file:cursor-pointer">
                        @error('photo') <p class="mt-1 text-sm text-terracotta">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('dashboard.fleet.show', $vehicle) }}" class="inline-flex items-center gap-1 text-sm text-charcoal/50 hover:text-charcoal transition-colors">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Back
                </a>
                <button type="submit" class="inline-flex items-center gap-2 bg-teal hover:bg-teal-light text-white px-6 py-2.5 rounded-lg font-medium transition-colors shadow-sm">
                    <i data-lucide="save" class="w-5 h-5"></i>
                    Update Vehicle
                </button>
            </div>
        </form>
    </div>
</x-layouts.dashboard>
