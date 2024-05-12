<x-guest-layout>
    <div class="container mx-auto mt-8 mb-6">
        <div class="flex flex-wrap items-center justify-center">
            <div class="w-full max-w-sm">
                <img class="rounded-full w-32 h-32 ml-32 mb-4 object-cover"
                    src="https://images.unsplash.com/photo-1509822929063-6b6cfc9b42f2?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80"
                    alt="login">
                <div class="flex flex-col break-words bg-white dark:bg-gray-800 rounded-lg shadow-md">

                    <div
                        class="font-semibold bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white py-3 px-6 mb-0 rounded-t-lg">
                        {{ __('Login') }}
                    </div>

                    {{-- Create admin button and coordinator/member button  login --}}
                    <div class="w-full p-6 flex flex-col gap-3">
                        <a href="{{ route('login') }}">
                            <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-6 rounded">
                                Admin
                            </button>
                        </a>
                        <a href="{{ route('passcode') }}">
                            <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-6 rounded">
                                Koordinator/Regu
                            </button>
                        </a>

                        <button onclick="Livewire.emit('openModal', 'guest.component.pick-car-booking')"
                            class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-6 rounded">
                            Peminjaman Kendaraan
                        </button>

                    </div>





                </div>
            </div>
        </div>
    </div>
    @push('js')
        @livewire('livewire-ui-modal')
    @endpush
</x-guest-layout>
