<x-app-layout>
    <x-content title="Pemesanan Kendaraan">
        {{-- Zip Download Button --}}
        <livewire:admin.car-booking-table />
    </x-content>
    @push('js')
        @livewire('livewire-ui-modal')
    @endpush
</x-app-layout>
