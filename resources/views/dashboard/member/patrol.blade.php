<x-app-layout>
    <!-- component -->



    <x-content title="Informasi Patroli">
        <div class="px-4 mt-4">
            <div id="data_tim">
                <div class="grid grid-cols-1 sm:grid-cols-2 sm:gap-3">
                    <div class="">
                        <div>
                            <p class="font-bold mb-0 mt-2">Nama Member 1</p>
                            <p>
                                {{ $patrol_schedule->member_1->name }}
                            </p>
                        </div>
                        <div>
                            <p class="font-bold mb-0 mt-2">Nama Member 2</p>
                            <p>
                                {{ $patrol_schedule->member_2->name }}
                            </p>
                        </div>
                        <div>
                            <p class="font-bold mb-0 mt-2">Shift</p>
                            <p>{{ $patrol_schedule->shift }}</p>
                        </div>
                        <div>
                            <p class="font-bold mb-0 mt-2">Hari, Tanggal</p>
                            <p>{{ \Carbon\Carbon::now()->format('d F Y') }}</p>
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

                        @if ($patrol_schedule->status == 'Belum Dilakukan')
                            <div class="flex justify-center">
                                <form class="w-1/2" action="{{ route('dashboard.member.patrol.start') }}"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" name="patrol_schedule_id" value="{{ $patrol_schedule->id }}">
                                    <button type="submit"
                                        class="bg-green-500 mb-4 sm:mb-1 w-full cursor-pointer text-center font-bold text-white px-3 py-2.5 m-1 rounded text-sm">Mulai
                                        Patroli</button>
                                </form>
                            </div>
                        @endif
                    </div>
                    <div>
                        <div id="map" style="height: 340px;"></div>
                        <div class="flex justify-center">
                            <button id="refresh-location"
                                class="bg-blue-500 mt-3 w-full cursor-pointer text-center font-bold text-white px-3 py-2.5 m-1 rounded text-sm">Perbaharui
                                Lokasi</button>
                        </div>
                        <div id="user-location-pin"></div>
                    </div>
                </div>
            </div>
        </div>
        <hr />

    </x-content>
    @push('js')
        @livewire('livewire-ui-modal')

        <script>
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
        </script>
    @endpush
</x-app-layout>
