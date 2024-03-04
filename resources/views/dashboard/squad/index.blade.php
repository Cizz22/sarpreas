<x-app-layout>
    <!-- component -->
    <x-content title="Penilaian">
        <div class="px-4 mt-4">
            <div id="data_tim">
                <div class="grid grid-cols-2">
                    <div>
                        <p class="font-bold mb-0 mt-2">Nama Regu</p>
                        <p>{{ $squad->name }}</p>
                    </div>
                    <div>
                        <p class="font-bold mb-0 mt-2">Hari, Tanggal</p>
                        <p>{{ \Carbon\Carbon::now()->format('d F Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full p-3">
            <p>Selamat datang di dashboard SKK, silahkan pilih menu dibawah sesuai tugas anda dan rekan anda pada hari
                dan sesi berikut</p> <b></b>
        </div>
    </x-content>
    <div class="flex max-w-full min-h-5 md:flex-row flex-col w-full gap-5">
        <x-content title="Patroli">
            <button class="w-full px-4 mt-3 py-2 mb-3 bg-green-500 mx-auto rounded text-white text-xl">
                Mulai Patroli
            </button>
        </x-content>
        <x-content title="Penjagaan Pos">
            <button class="w-full px-4 py-2 mt-3 mb-3 bg-green-500 mx-auto rounded text-white text-xl">
                Mulai Penjagaan Pos
            </button>
        </x-content>
        <x-content title="Penjagaan Gedung">
            <button class="w-full px-4 py-2 mt-3 mb-3 bg-green-500 mx-auto rounded text-white text-xl">
                Mulai Penjagaan Gedung
            </button>
        </x-content>

    </div>
    @push('js')
        @livewire('livewire-ui-modal')
    @endpush
</x-app-layout>
