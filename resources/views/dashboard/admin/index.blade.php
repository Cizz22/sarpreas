<x-app-layout>
    <div class="lg:flex items-center justify-between gap-x-3 sm:space-y-4 md:space-y-2 lg:space-y-1 pb-4">

        {{-- <x-card type="four">
            <div class="flex-1 text-left">
                <div class="text-sm font-semibold uppercase tracking-tight text-yellow-500 dark:text-yellow-400 mb-2">
                    PENDING REQUESTS</div>
                <div class="text-2xl font-semibold text-gray-700 dark:text-white leading-normal tracking-widest">
                    18</div>
            </div>
            <div class="text-right">
                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 100 100"><title>31</title><g><g id="31.-Papers" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round"><path id="Layer-1" stroke="#E4EBF4" stroke-width="4" fill="#E4EBF4" d="M24 90h52v8H24z"></path><path id="Layer-2" stroke="#D1DDEB" stroke-width="4" fill="#D1DDEB" d="M20 82h60v8H20z"></path><path id="Layer-3" stroke="#C1D0E0" stroke-width="4" fill="#C1D0E0" d="M16 74h68v8H16z"></path><path id="Layer-4" stroke="#A4B8CE" stroke-width="4" fill="#A4B8CE" d="M72.069 2L12 2.18v71.895h76V17.758L72.25 2.18z"></path><path id="Layer-5" stroke="#8DA1B7" stroke-width="4" fill="#8DA1B7" d="M88 18H72V2z"></path></g></g></svg> --}}
                {{-- <svg class="fill-current text-yellow-500 dark:text-yellow-400" xmlns="http://www.w3.org/2000/svg"
                    width="50" height="50" viewBox="0 0 20 20">
                    <title>inbox-download</title>
                    <g fill="text-orange-400">
                        <path
                            d="M0 2C0 .9.9 0 2 0h16a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm14 12h4V2H2v12h4c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2zM9 8V5h2v3h3l-4 4-4-4h3z">
                        </path>
                    </g>
                </svg>
            </div>
        </x-card> --}}
    </div>


    <x-content title="Laporan SKK">
        <form class="w-full max-w-full" action="{{ route('dashboard.admin.reportSKK') }}" method="post"
            autocomplete="off">
            @csrf
            <div class="flex flex-wrap mb-6">
                <x-input-label for="unit" value="Unit" />

                <select
                    class="block mt-1 mb-3 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'"
                    name="unit">
                    <option value="">Pilih Unit</option>
                    @foreach ($unit as $u)
                        @if ($u->name == 'Kebersihan')
                            @continue
                        @endif
                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                    @endforeach
                </select>

                <x-input-label for="shift" value="Shift" />
                <select
                    class="block mt-1 mb-3 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'"
                    name="shift">
                    <option value="">Pilih Unit</option>
                    <option value="all">Semua shift</option>
                    <option value="Pagi">Pagi</option>
                    <option value="Siang">Siang</option>
                    <option value="Malam">Malam</option>
                </select>

                <x-input-label for="date" value="Tanggal" />

                <input type="date" name="date"
                    class="block mt-1 mb-3 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'" />


                <div class="flex flex-wrap mb-2 justify-end mt-3">
                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full"
                        type="submit">
                        <span>Tampilkan</span>
                    </button>
                </div>
            </div>
        </form>

        @if ($userInputProvidedSKK)
            <livewire:admin.report-s-k-k-table unitInput="{{ $unitInput }}" dateInput="{{ $dateInput }}"
                shiftInput="{{ $shiftInput }}" />
        @endif
    </x-content>

    <x-content title="Hasil Penilaian">
        <form class="w-full max-w-full" action="{{ route('dashboard.admin.report') }}" method="post"
            autocomplete="off">
            @csrf
            <div class="flex flex-wrap mb-6">
                <x-input-label for="unit" value="Unit" />

                <select
                    class="block mt-1 mb-3 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'"
                    name="unit">
                    <option value="">Pilih Unit</option>
                    @foreach ($unit as $u)
                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                    @endforeach
                </select>

                <x-input-label for="month" value="Bulan" />

                <select
                    class="block mt-1 mb-3 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'"
                    name="month">
                    <option value="">Pilih Bulan</option>
                    @foreach ($month as $m)
                        <option value="{{ $m->month }}">
                            {{ \Carbon\Carbon::createFromFormat('m', $m->month)->format('F') }}</option>
                    @endforeach
                </select>

                <x-input-label for="name" value="Tahun" />

                <select
                    class="block mt-1 mb-3 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'"
                    name="year">
                    <option value="">Pilih Tahun</option>
                    @foreach ($year as $y)
                        <option value="{{ $y->year }}">
                            {{ $y->year }}</option>
                    @endforeach
                </select>
                <div class="flex flex-wrap mb-2 justify-end mt-3">
                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full"
                        type="submit">
                        <span>Tampilkan</span>
                    </button>
                </div>
            </div>
        </form>

        @if ($userInputProvided)
            <livewire:admin.report-table monthInput="{{ $monthInput }}" yearInput="{{ $yearInput }}"
                unitInput="{{ $unitInput }}" />
        @endif
    </x-content>






    @push('js')
        @livewire('livewire-ui-modal')
    @endpush
</x-app-layout>
