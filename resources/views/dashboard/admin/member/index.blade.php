<x-app-layout>
    <x-content title="Member">
        {{-- Zip Download Button --}}
        <livewire:admin.member-table />

    </x-content>
    @push('js')
        @livewire('livewire-ui-modal')
    @endpush
</x-app-layout>
