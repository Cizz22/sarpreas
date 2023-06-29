<x-app-layout>
    <x-content title="Unit">
        {{-- Zip Download Button --}}
        <livewire:admin.unit-table/>
    </x-content>
    @push('js')
        @livewire('livewire-ui-modal')
    @endpush
</x-app-layout>
