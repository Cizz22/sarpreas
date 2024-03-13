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
            @if ($interval_schedule->sessionSchedule()->where('type', 'patroli')->exists())
                <a class="w-full" href="{{ route('dashboard.member.patrol') }}">
                    <button class="w-full px-4 mt-3 py-2 mb-3 bg-blue-500 mx-auto rounded text-white text-xl">
                        Lanjutkan Patroli
                    </button>
                </a>
            @else
                <button
                    onclick="Livewire.emit('openModal', 'squad.components.modal-component', {{ json_encode(['tugas' => 'Patroli', 'interval_schedule' => $interval_schedule->id, 'type' => 'patroli']) }})"
                    class="w-full px-4 mt-3 py-2 mb-3 bg-green-500 mx-auto rounded text-white text-xl">
                    Mulai Patroli
                </button>
            @endif
        </x-content>
        <x-content title="Penjagaan Pos">
            @if ($interval_schedule->sessionSchedule()->where('type', 'pos')->exists())
                <a class="w-full" href="{{ route('dashboard.member.posgedung', ['type' => 'pos']) }}">
                    <button class="w-full px-4 mt-3 py-2 mb-3 bg-blue-500 mx-auto rounded text-white text-xl">
                        Lanjutkan Penjagaan Pos
                    </button>
                </a>
            @else
                <button
                    onclick="Livewire.emit('openModal', 'squad.components.modal-component', {{ json_encode(['tugas' => 'Penjagaan Pos', 'interval_schedule' => $interval_schedule->id, 'type' => 'pos']) }})"
                    class="w-full px-4 py-2 mt-3 mb-3 bg-green-500 mx-auto rounded text-white text-xl">
                    Mulai Penjagaan Pos
                </button>
            @endif
        </x-content>
        <x-content title="Penjagaan Gedung">
            @if($interval_schedule->sessionSchedule()->where('type', 'gedung')->exists())
                <a class="w-full" href="{{ route('dashboard.member.posgedung', ['type' => 'gedung']) }}">
                    <button class="w-full px-4 mt-3 py-2 mb-3 bg-blue-500 mx-auto rounded text-white text-xl">
                        Lanjutkan Penjagaan Gedung
                    </button>
                </a>
            @else
            <button
                onclick="Livewire.emit('openModal', 'squad.components.modal-component', {{ json_encode(['tugas' => 'Penjagaan Gedung', 'interval_schedule' => $interval_schedule->id, 'type' => 'gedung']) }})"
                class="w-full px-4 py-2 mt-3 mb-3 bg-green-500 mx-auto rounded text-white text-xl">
                Mulai Penjagaan Gedung
            </button>
            @endif
        </x-content>
    </div>
    @push('js')
        @livewire('livewire-ui-modal')

        <script>
            function dropdown() {
                return {
                    options: [],
                    selected: [],
                    show: false,
                    open() {
                        this.show = true;
                    },
                    close() {
                        this.show = false;
                    },
                    isOpen() {
                        return this.show === true;
                    },
                    select(index, event) {
                        if (!this.options[index].selected) {
                            this.options[index].selected = true;
                            this.options[index].element = event.target;
                            this.selected.push(index);
                        } else {
                            this.selected.splice(this.selected.lastIndexOf(index), 1);
                            this.options[index].selected = false;
                        }
                    },
                    remove(index, option) {
                        this.options[option].selected = false;
                        this.selected.splice(index, 1);
                    },
                    loadOptions() {
                        const options = document.getElementById("select").options;
                        for (let i = 0; i < options.length; i++) {
                            this.options.push({
                                value: options[i].value,
                                text: options[i].innerText,
                                selected: options[i].getAttribute("selected") != null ?
                                    options[i].getAttribute("selected") : false,
                            });
                        }
                    },
                    selectedValues() {
                        return this.selected.map((option) => {
                            return this.options[option].value;
                        });
                    },
                };
            }
        </script>
    @endpush
</x-app-layout>
