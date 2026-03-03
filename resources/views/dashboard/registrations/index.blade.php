<x-layouts.dashboard title="Registrations" header="Registrations">
    <!-- Search & Filters -->
    <div class="bg-white rounded-xl border border-warm-gray/30 p-5 mb-6">
        <form action="{{ route('dashboard.registrations.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search by code, name, email, or phone..."
                class="flex-1 px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all"
            >
            <select name="status" class="px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all bg-white">
                <option value="">All Statuses</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }}>Expired</option>
            </select>
            <button type="submit" class="inline-flex items-center gap-2 bg-navy hover:bg-navy-light text-white px-5 py-2.5 rounded-lg font-medium transition-colors">
                <i data-lucide="search" class="w-4 h-4"></i>
                Search
            </button>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl border border-warm-gray/30 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-sand">
                    <tr>
                        <th class="text-left px-6 py-3 text-xs font-medium text-charcoal/60 uppercase tracking-wider">Code</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-charcoal/60 uppercase tracking-wider">Customer</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-charcoal/60 uppercase tracking-wider">Dates</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-charcoal/60 uppercase tracking-wider">Preference</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-charcoal/60 uppercase tracking-wider">Status</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-charcoal/60 uppercase tracking-wider">Registered</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-charcoal/60 uppercase tracking-wider"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-warm-gray/30">
                    @forelse($registrations as $reg)
                    <tr class="hover:bg-sand/50 transition-colors">
                        <td class="px-6 py-4">
                            <span class="font-mono text-sm font-semibold text-navy">{{ $reg->confirmation_code }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-medium text-charcoal text-sm">{{ $reg->full_name }}</p>
                            <p class="text-xs text-charcoal/50">{{ $reg->email }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-charcoal/70">
                            {{ $reg->pickup_date->format('M d') }} - {{ $reg->return_date->format('M d, Y') }}
                        </td>
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
                        <td class="px-6 py-4 text-sm text-charcoal/50">{{ $reg->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('dashboard.registrations.show', $reg) }}" class="text-teal hover:text-teal-dark text-sm font-medium transition-colors">
                                View
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-charcoal/40">
                            <i data-lucide="inbox" class="w-12 h-12 mx-auto mb-3 text-charcoal/20"></i>
                            <p>No registrations found.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($registrations->hasPages())
        <div class="px-6 py-4 border-t border-warm-gray/30">
            {{ $registrations->withQueryString()->links() }}
        </div>
        @endif
    </div>
</x-layouts.dashboard>
