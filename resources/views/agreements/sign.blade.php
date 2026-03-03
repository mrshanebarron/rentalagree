<x-layouts.agreement title="Sign Agreement {{ $agreement->agreement_number }}">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <livewire:agreement-wizard :agreement="$agreement" />
    </div>
</x-layouts.agreement>
