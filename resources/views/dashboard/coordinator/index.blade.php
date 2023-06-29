<x-app-layout>
    <!-- component -->
    <x-content title="Penilaian">
        <div class="px-4 mt-4">
            <div id="data_tim">
                <div class="grid grid-cols-2">
                    <div>
                        <p class="font-bold mb-0 mt-2">Nama Subunit</p>
                        <p>{{ $subunit->name }}</p>
                    </div>
                    <div>
                        <p class="font-bold mb-0 mt-2">Koordinator</p>
                        <p>{{ $subunit->coordinator->name }}</p>
                    </div>
                    <div>
                        <p class="font-bold mb-0 mt-2">Hari, Tanggal</p>
                        <p>{{ \Carbon\Carbon::now()->format('d F Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <hr />
        <div class="bg-white rounded-md w-full">
            <div>
                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Nama
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        No HP
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Status Penilaian
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subunit->subunitMember as $s)
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $s->memberable->name }}</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $s->memberable->no_hp }}</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                <span aria-hidden
                                                    class="absolute inset-0 {{ $s->memberable->scoreMember()->whereDate('created_at', today())->exists()? 'bg-green-500': 'bg-red-500' }} opacity-50 rounded-full"></span>
                                                <span
                                                    class="relative text-white">{{ $s->memberable->scoreMember()->whereDate('created_at', today())->exists()? 'Sudah Dinilai': 'Belum Dinilai' }}</span>
                                            </span>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            @if (!$s->memberable->scoreMember()->whereDate('created_at', today())->exists())
                                                <button
                                                    onclick="Livewire.emit('openModal', 'coordinator.components.modal-scoring', {{ json_encode(['member_id' => $s->memberable_id, 'subunit_id' => $subunit->id]) }})"
                                                    class="bg-green-500 cursor-pointer text-white px-3 py-1 rounded text-sm">
                                                    <i class="fas fa-edit"></i> Nilai
                                                </button>
                                            @endif
                                        </td>
                                        {{-- <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <span
                                            class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                            <span aria-hidden
                                                class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                            <span class="relative">Activo</span>
                                        </span>
                                    </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-content>
    @push('js')
        @livewire('livewire-ui-modal')
    @endpush
</x-app-layout>
