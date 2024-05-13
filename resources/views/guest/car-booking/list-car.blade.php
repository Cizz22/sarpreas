<x-guest-layout>
    <!-- component -->
    <section class="">
        <div class="container max-w-screen px-1 py-10 mx-auto">
            <h2 class="just h-20 mx-auto">Daftar Kendaraan</h2>
            <div class="max-w-lg mx-auto mb-8">
                <form action="{{ route('peminjaman.list-kendaraan') }}" method="GET" class="flex">
                    <label for="search" class="sr-only">Search for a car:</label>
                    <input id="search" type="text" name="search" placeholder="Search..."
                        class="w-full border border-gray-300 rounded-l-md py-2 px-4 focus:outline-none focus:border-blue-500">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-r-md">Search</button>
                </form>
            </div>

            <div
                class="grid grid-flow-row gap-8 text-neutral-600 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                <!-- component -->
                @foreach ($cars as $car)
                    <div
                        class="relative flex w-full flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-lg">
                        <a href="{{ $car->image }}" target="_blank">
                            <div
                                class="relative mx-4 mt-4 overflow-hidden rounded-xl bg-blue-gray-500 bg-clip-border text-white shadow-lg shadow-blue-gray-500/40">
                                <img class="rounded-t h-72 w-full object-cover" src="{{ $car->image }}"
                                    alt="kendaraan" />
                                <div
                                    class="to-bg-black-10 absolute inset-0 h-full w-full bg-gradient-to-tr from-transparent via-transparent to-black/60">
                                </div>
                            </div>
                        </a>

                        <div class="p-6">
                            <div class="mb-3 flex items-center justify-between">
                                <h5
                                    class="block font-sans text-xl font-medium leading-snug tracking-normal text-blue-gray-900 antialiased">
                                    {{ $car->name }}
                                </h5>
                            </div>
                            <p class="block font-sans text-base font-light leading-relaxed text-gray-700 antialiased">
                                Kapasitas {{ $car->capacity }} orang
                            </p>
                        </div>
                        <div class=" px-2 pb-2 flex-col flex md:flex-row gap-3">
                            <a href="{{ route('peminjaman.form', ['carId' => $car->id]) }}" class="w-full">
                                <button
                                    class="block w-full select-none rounded-lg bg-green-500 py-3.5 px-7 text-center align-middle font-sans text-sm font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all hover:shadow-lg hover:shadow-pink-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button">
                                    Reservasi
                                </button>
                            </a>

                            <button onclick="Livewire.emit('openModal', 'guest.component.date-modal')"
                                class="block w-full select-none rounded-lg bg-blue-500 text-center align-middle font-sans text-sm font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all hover:shadow-lg hover:shadow-pink-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                type="button">
                                Periksa Tanggal
                            </button>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    @push('js')
        @livewire('livewire-ui-modal')
    @endpush
</x-guest-layout>
