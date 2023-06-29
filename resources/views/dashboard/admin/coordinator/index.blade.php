<x-app-layout>
    <x-content title="Koordinator">
        {{-- Zip Download Button --}}
        <livewire:admin.coordinator-table />
    </x-content>
    @push('js')
        @livewire('livewire-ui-modal')
    @endpush
</x-app-layout>
