<x-app-layout>
    <x-content title="Instrumen">
        {{-- Zip Download Button --}}
        <livewire:admin.instrument-table />
    </x-content>
    @push('js')
        @livewire('livewire-ui-modal')
    @endpush
</x-app-layout>
