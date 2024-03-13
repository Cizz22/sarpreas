<x-app-layout>
    <!-- component -->
    {{-- Carausel --}}
    <x-content title="Checkpoint">
        <div id="loading" style="display: none">
            <div class="flex items-center justify-center min-h-screen p-5 bg-gray-100 min-w-screen">

                <div class="flex space-x-2 animate-pulse">
                    <div class="w-3 h-3 bg-gray-500 rounded-full"></div>
                    <div class="w-3 h-3 bg-gray-500 rounded-full"></div>
                    <div class="w-3 h-3 bg-gray-500 rounded-full"></div>
                </div>

            </div>
        </div>


        <div id="checkpoint">


            <div class="relative w-full">

                <!-- Carousel wrapper -->
                <div class="relative h-56 overflow-hidden rounded-lg sm:h-64 xl:h-80 2xl:h-96">
                    @foreach ($checkpoints as $checkpoint)
                        <div id="carousel-item-{{ $loop->index + 1 }}" class="hidden duration-700 ease-in-out">
                            <div class="relative">
                                <!-- Image -->
                                <img src="https://images.unsplash.com/photo-1499856871958-5b9627545d1a"
                                    class="absolute block w-full -translate-x-1/2 sm:-translate-y-1/2 top-1/2 left-1/2"
                                    alt="...">

                                <!-- Text on top of the image -->
                                <div class="absolute top-0 left-0 right-0 text-center text-white bg-transparent">
                                    <h2 class="text-2xl text-white font-semibold">Checkpoint {{ $loop->index + 1 }}
                                    </h2>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- Item 1 -->

                </div>
                <!-- Slider indicators -->
                <div class="absolute z-25 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
                    <button id="carousel-indicator-1" type="button" class="w-3 h-3 rounded-full" aria-current="true"
                        aria-label="Slide 1"></button>
                    <button id="carousel-indicator-2" type="button" class="w-3 h-3 rounded-full" aria-current="false"
                        aria-label="Slide 2"></button>
                    <button id="carousel-indicator-3" type="button" class="w-3 h-3 rounded-full" aria-current="false"
                        aria-label="Slide 3"></button>
                    <button id="carousel-indicator-4" type="button" class="w-3 h-3 rounded-full" aria-current="false"
                        aria-label="Slide 4"></button>
                </div>
                <!-- Slider controls -->
                <button id="data-carousel-prev" type="button"
                    class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none">
                    <span
                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 1 1 5l4 4" />
                        </svg>
                        <span class="hidden">Previous</span>
                    </span>
                </button>
                <button id="data-carousel-next" type="button"
                    class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none">
                    <span
                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="hidden">Next</span>
                    </span>
                </button>
            </div>
            <div id="data_lokasi">
                <div id="before_submit">
                    <div class="grid grid-cols-1 sm:gap-3">
                        <div>
                            <p class="font-bold mb-0 mt-2">Nama Lokasi</p>
                            <p id="lokasi"></p>
                        </div>

                        <div id="keterangan_tambahan">
                            <p class="font-bold mb-0 mt-2">Keterangan Tambahan</p>

                            <textarea rows="3" id="additional_infomation_input"
                                class="rounded-md w-full shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                placeholder="Keterangan tambahan"></textarea>

                            <p id="additional_information_p">-</p>
                            @error('keterangan')
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div id="situation_button">
                            <p class="font-bold mb-0 mt-2">Keadaan</p>
                            <p id="situation"></p>
                            <div class="flex justify-evenly" id="situation_button_input">
                                <button id="aman"
                                    class="bg-green-500 mb-4 sm:mb-1 w-full sm:w-1/2 cursor-pointer text-center font-bold text-white px-3 py-2.5 m-1 rounded text-sm">
                                    Aman
                                </button>
                                <button id="terkendala"
                                    class="bg-red-500 mb-4 sm:mb-1 w-full sm:w-1/2 cursor-pointer text-center font-bold text-white px-3 py-2.5 m-1 rounded text-sm">
                                    Terkendala
                                </button>
                            </div>

                        </div>
                    </div>

                    <form id="patrolForm" method="POST" action="{{ route('dashboard.member.posgedung.checkpoint') }}">
                        @csrf
                        <input type="hidden" id="type" name="type" value="{{ $type }}">
                        <input type="hidden" id="status" name="status">
                        <input type="hidden" id="keterangan" name="keterangan">
                        <input type="hidden" id="position" name="position">
                        <input type="hidden" id="patrol_schedule_id" name="patrol_schedule_id"
                            value="{{ $patrol_schedule->id }}">
                        <input type="hidden" id="interval" name="interval">
                        <input type="hidden" id="lat" name="lat">
                        <input type="hidden" id="long" name="long">
                    </form>
                </div>

            </div>

        </div>

    </x-content>

    <x-content title="Informasi Patroli">
        <div class="px-4 mt-4">
            <div id="data_tim">
                <div class="grid grid-cols-1 sm:grid-cols-2 sm:gap-3">
                    <div class="">
                        @foreach ($patrol_schedule->members as $index => $member)
                            <div>
                                <p class="font-bold mb-0 mt-2">Nama Member {{ $index + 1 }}</p>
                                <p>
                                    {{ $member->member->name }}
                                </p>
                            </div>
                        @endforeach

                        <div>
                            <p class="font-bold mb-0 mt-2">Shift</p>
                            <p>{{ $patrol_schedule->intervalSchedule->shiftSchedule->type }}</p>
                        </div>
                        <div>
                            <p class="font-bold mb-0 mt-2">Hari, Tanggal</p>
                            <p>{{ $patrol_schedule->intervalSchedule->date }}</p>
                        </div>
                        <div>
                            <p class="font-bold mb-0 mt-2">Status Patroli</p>
                            <p>
                                <span
                                    class="{{ $patrol_schedule->status === 'Belum Dilakukan' ? 'bg-red-500' : ($patrol_schedule->status === 'Sedang Dilakukan' ? 'bg-blue-500' : 'bg-green-500') }} px-2 py-2 inline-flex leading-5 font-semibold rounded-full text-white">
                                    {{ $patrol_schedule->status }}
                                </span>
                            </p>
                        </div>
                    </div>
                    {{-- <div>
                        <div id="map" style="height: 340px;"></div>
                        <div class="flex justify-center">
                            <button id="refresh-location"
                                class="bg-blue-500 mt-3 w-full cursor-pointer text-center font-bold text-white px-3 py-2.5 m-1 rounded text-sm">Perbaharui
                                Lokasi</button>
                        </div>
                        <div id="user-location-pin"></div>
                    </div> --}}
                </div>
            </div>
        </div>
    </x-content>
    @push('js')
        @livewire('livewire-ui-modal')

        <script>
            const items = []
            let default_position = {{ $default_position }};

            @foreach ($checkpoints as $checkpoint)
                item = {
                    position: {{ $loop->index }},
                    interval: "{{ $checkpoint['time'] }}",
                    location: "{{ $checkpoint['name'] }}",
                    is_done: "{{ $checkpoint['is_done'] }}",
                    situasi: "{{ $checkpoint['report']['situation'] }}",
                    keterangan: "{{ $checkpoint['report']['additional_information'] }}",
                    el: document.getElementById('carousel-item-{{ $loop->index + 1 }}')
                }

                items.push(item)
            @endforeach

            console.log(items)

            const carousel = new Carousel(items, {
                defaultPosition: default_position
            });

            // set event listeners for prev and next buttons and location
            const $prevButton = document.getElementById('data-carousel-prev');
            const $nextButton = document.getElementById('data-carousel-next');

            const $location = document.getElementById('lokasi');

            // SET location name
            $location.innerHTML = carousel._activeItem.location;
            showHide(carousel._activeItem.is_done)

            $prevButton.addEventListener('click', () => {
                carousel.prev();
                $location.innerHTML = carousel._activeItem.location;

                showHide(carousel._activeItem.is_done)
            });

            $nextButton.addEventListener('click', () => {
                carousel.next();
                $location.innerHTML = carousel._activeItem.location;

                showHide(carousel._activeItem.is_done)
            });


            function showHide(is_done) {
                if (is_done) {
                    document.getElementById('situation_button_input').style.display = 'none';
                    document.getElementById('situation').innerHTML = carousel._activeItem.situasi;

                    document.getElementById('additional_infomation_input').style.display = 'none';
                    document.getElementById('additional_information_p').innerHTML = carousel._activeItem.keterangan;

                } else {
                    document.getElementById('situation_button_input').style.display = 'flex';
                    document.getElementById('situation').innerHTML = "";

                    document.getElementById('additional_infomation_input').style.display = 'flex';
                    document.getElementById('additional_information_p').innerHTML = "";
                }
            }

            function submitForm(situation) {
                const form = document.getElementById('patrolForm');
                const sit = situation

                navigator.geolocation.getCurrentPosition(function(position) {
                    document.getElementById('status').value = sit;
                    document.getElementById('keterangan').value = document.getElementById(
                        'additional_infomation_input').value;
                    document.getElementById('position').value = carousel._activeItem.position;
                    document.getElementById('interval').value = carousel._activeItem.interval;
                    document.getElementById('lat').value = position.coords.latitude;
                    document.getElementById('long').value = position.coords.longitude;
                    form.submit()
                })
            }

            // Aman & Terkendala Button
            const $amanButton = document.getElementById('aman');
            const $terkendalaButton = document.getElementById('terkendala');
            const $checkpoint = document.getElementById('checkpoint');
            const $loading = document.getElementById('loading')



            $amanButton.addEventListener('click', () => {
                $loading.style.display = "block";
                $checkpoint.style.display = "none";
                submitForm('aman');
            });

            $terkendalaButton.addEventListener('click', () => {
                $loading.style.display = "block";
                $checkpoint.style.display = "none";
                submitForm('terkendala');

            });
        </script>

        {{-- <script>
            var map = L.map('map');
            var refreshButton = document.getElementById('refresh-location');
            var userLocationPin = L.marker([0, 0]); // Inisialisasi marker dengan koordinat awal (0, 0)

            // Initialize the map without setting a specific center
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);

            // Function to update the map with the user's current location and add a pin
            function updateLocation() {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat = position.coords.latitude;
                    var lng = position.coords.longitude;

                    // Set the map center to the user's current location
                    map.setView([lat, lng], 13);

                    // Update the marker position
                    userLocationPin.setLatLng([lat, lng]).addTo(map);

                    // Calculate the bounds (bounding box) of all markers
                    var bounds = L.latLngBounds(markerLocations);

                    // Fit the map to the bounds, automatically adjusting zoom
                    map.fitBounds(bounds);
                });
            }

            // Initial map setup
            updateLocation();

            // Add an event listener to the "Perbaharui Lokasi" button
            refreshButton.addEventListener('click', function() {
                updateLocation();
            });

            // You can customize the marker icon and popup content as needed
            userLocationPin.bindPopup("Lokasi Anda").openPopup(); // Contoh popup dengan teks "Lokasi Anda"
        </script> --}}
    @endpush
</x-app-layout>
