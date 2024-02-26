<x-app-layout>
    <x-content title="Kendaraan">
        {{-- Zip Download Button --}}
        <livewire:admin.car-table/>
    </x-content>
    @push('js')
        @livewire('livewire-ui-modal')
    @endpush
</x-app-layout>
