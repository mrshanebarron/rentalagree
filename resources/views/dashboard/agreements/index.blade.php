<x-layouts.dashboard title="Agreements" header="Agreements">
    <!-- Search & Filters -->
    <div class="bg-white rounded-xl border border-warm-gray/30 p-5 mb-6">
        <form action="{{ route('dashboard.agreements.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search by agreement number or customer name..."
                class="flex-1 px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all"
            >
            <select name="status" class="px-4 py-2.5 rounded-lg border border-warm-gray focus:border-teal focus:ring-2 focus:ring-teal/20 outline-none transition-all bg-white">
                <option value="">All Statuses</option>
                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="signed" {{ request('status') === 'signed' ? 'selected' : '' }}>Signed</option>
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
                        <th class="text-left px-6 py-3 text-xs font-medium text-charcoal/60 uppercase tracking-wider">Agreement</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-charcoal/60 uppercase tracking-wider">Customer</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-charcoal/60 uppercase tracking-wider">Vehicle</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-charcoal/60 uppercase tracking-wider">Dates</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-charcoal/60 uppercase tracking-wider">Status</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-charcoal/60 uppercase tracking-wider">Signed</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-charcoal/60 uppercase tracking-wider"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-warm-gray/30">
                    @forelse($agreements as $agreement)
                    <tr class="hover:bg-sand/50 transition-colors">
                        <td class="px-6 py-4">
                            <span class="font-mono text-sm font-semibold text-navy">{{ $agreement->agreement_number }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-medium text-charcoal text-sm">{{ $agreement->registration->full_name }}</p>
                            <p class="text-xs text-charcoal/50">{{ $agreement->registration->email }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-charcoal">{{ $agreement->vehicle->full_name }}</p>
                            <p class="text-xs text-charcoal/50">{{ $agreement->vehicle->license_plate }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-charcoal/70">
                            {{ $agreement->pickup_date->format('M d') }} - {{ $agreement->return_date->format('M d') }}
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $colors = ['draft' => 'bg-gray-100 text-gray-700', 'in_progress' => 'bg-blue-100 text-blue-800', 'signed' => 'bg-green-100 text-green-800', 'expired' => 'bg-red-100 text-red-800'];
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $colors[$agreement->status] }}">
                                {{ str_replace('_', ' ', ucfirst($agreement->status)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-charcoal/50">
                            {{ $agreement->signed_at ? $agreement->signed_at->format('M d, Y') : '—' }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('dashboard.agreements.show', $agreement) }}" class="text-teal hover:text-teal-dark text-sm font-medium transition-colors">View</a>
                                @if($agreement->status === 'signed')
                                <a href="{{ route('dashboard.agreements.pdf', $agreement) }}" class="text-navy hover:text-navy-light text-sm font-medium transition-colors flex items-center gap-1">
                                    <i data-lucide="download" class="w-3.5 h-3.5"></i>
                                    PDF
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-charcoal/40">
                            <i data-lucide="file-x" class="w-12 h-12 mx-auto mb-3 text-charcoal/20"></i>
                            <p>No agreements found.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($agreements->hasPages())
        <div class="px-6 py-4 border-t border-warm-gray/30">
            {{ $agreements->withQueryString()->links() }}
        </div>
        @endif
    </div>
</x-layouts.dashboard>
