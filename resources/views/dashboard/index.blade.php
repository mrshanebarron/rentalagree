<x-layouts.dashboard title="Dashboard" header="Dashboard">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <div class="bg-white rounded-xl border border-warm-gray/30 p-5 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-teal/10 rounded-lg flex items-center justify-center">
                    <i data-lucide="clipboard-list" class="w-5 h-5 text-teal"></i>
                </div>
                <span class="text-xs text-charcoal/40 font-medium uppercase tracking-wider">Today</span>
            </div>
            <p class="text-2xl font-bold text-navy">{{ $todayRegistrations }}</p>
            <p class="text-sm text-charcoal/60 mt-1">New Registrations</p>
        </div>
        <div class="bg-white rounded-xl border border-warm-gray/30 p-5 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-terracotta/10 rounded-lg flex items-center justify-center">
                    <i data-lucide="clock" class="w-5 h-5 text-terracotta"></i>
                </div>
                <span class="text-xs text-charcoal/40 font-medium uppercase tracking-wider">Active</span>
            </div>
            <p class="text-2xl font-bold text-navy">{{ $pendingAgreements }}</p>
            <p class="text-sm text-charcoal/60 mt-1">Pending Agreements</p>
        </div>
        <div class="bg-white rounded-xl border border-warm-gray/30 p-5 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i>
                </div>
                <span class="text-xs text-charcoal/40 font-medium uppercase tracking-wider">Today</span>
            </div>
            <p class="text-2xl font-bold text-navy">{{ $completedToday }}</p>
            <p class="text-sm text-charcoal/60 mt-1">Completed Today</p>
        </div>
        <div class="bg-white rounded-xl border border-warm-gray/30 p-5 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-navy/10 rounded-lg flex items-center justify-center">
                    <i data-lucide="car" class="w-5 h-5 text-navy"></i>
                </div>
                <span class="text-xs text-charcoal/40 font-medium uppercase tracking-wider">Now</span>
            </div>
            <p class="text-2xl font-bold text-navy">{{ $activeRentals }}</p>
            <p class="text-sm text-charcoal/60 mt-1">Active Rentals</p>
        </div>
    </div>

    <!-- Quick Search -->
    <div class="bg-white rounded-xl border border-warm-gray/30 p-6 mb-8">
        <h2 class="font-serif-display text-lg text-navy mb-4 flex items-center gap-2">
            <i data-lucide="search" class="w-5 h-5 text-teal"></i>
            Customer Lookup
        </h2>
        <form action="{{ route('dashboard.registrations.index') }}" method="GET" class="flex gap-3">
            <input
                type="text"
                name="search"
                placeholder="Search by confirmation code, name, email, or phone..."
                class="flex-1 px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all"
            >
            <button type="submit" class="inline-flex items-center gap-2 bg-navy hover:bg-navy-light text-white px-6 py-2.5 rounded-lg font-medium transition-colors">
                <i data-lucide="search" class="w-4 h-4"></i>
                Search
            </button>
        </form>
    </div>

    <!-- Recent Registrations -->
    <div class="bg-white rounded-xl border border-warm-gray/30 overflow-hidden">
        <div class="px-6 py-4 border-b border-warm-gray/30 flex items-center justify-between">
            <h2 class="font-serif-display text-lg text-navy">Recent Registrations</h2>
            <a href="{{ route('dashboard.registrations.index') }}" class="text-sm text-teal hover:text-teal-dark font-medium flex items-center gap-1 transition-colors">
                View All <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-sand">
                    <tr>
                        <th class="text-left px-6 py-3 text-xs font-medium text-charcoal/60 uppercase tracking-wider">Code</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-charcoal/60 uppercase tracking-wider">Customer</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-charcoal/60 uppercase tracking-wider">Pickup</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-charcoal/60 uppercase tracking-wider">Preference</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-charcoal/60 uppercase tracking-wider">Status</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-charcoal/60 uppercase tracking-wider"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-warm-gray/30">
                    @forelse($recentRegistrations as $reg)
                    <tr class="hover:bg-sand/50 transition-colors">
                        <td class="px-6 py-4">
                            <span class="font-mono text-sm font-semibold text-navy">{{ $reg->confirmation_code }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-medium text-charcoal text-sm">{{ $reg->full_name }}</p>
                                <p class="text-xs text-charcoal/50">{{ $reg->email }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-charcoal/70">{{ $reg->pickup_date->format('M d, Y') }}</td>
                        <td class="px-6 py-4">
                            <span class="text-sm capitalize text-charcoal/70">{{ $reg->vehicle_preference }}</span>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $colors = ['pending' => 'bg-yellow-100 text-yellow-800', 'in_progress' => 'bg-blue-100 text-blue-800', 'completed' => 'bg-green-100 text-green-800', 'expired' => 'bg-red-100 text-red-800'];
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $colors[$reg->status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ str_replace('_', ' ', ucfirst($reg->status)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('dashboard.registrations.show', $reg) }}" class="text-teal hover:text-teal-dark text-sm font-medium transition-colors">
                                View
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-charcoal/40">No registrations yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.dashboard>
