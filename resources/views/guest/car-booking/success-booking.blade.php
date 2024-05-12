<x-guest-layout>
    <div class="max-w-lg mx-auto my-10 bg-white rounded-lg shadow-md p-5">
        <img class="w-32 h-32 rounded-full mx-auto" src="https://picsum.photos/200" alt="Profile picture">
        <h2 class="text-center text-2xl font-semibold mt-3"></h2>
        {{-- <p class="text-center text-gray-600 mt-1">Software Engineer</p> --}}
        {{-- <div class="flex justify-center mt-5">
            <a href="#" class="text-blue-500 hover:text-blue-700 mx-3">Twitter</a>
            <a href="#" class="text-blue-500 hover:text-blue-700 mx-3">LinkedIn</a>
            <a href="#" class="text-blue-500 hover:text-blue-700 mx-3">GitHub</a>
        </div> --}}
        <div class="mt-5">
            <p class="text-gray-600 mt-2">Pemesanan anda berhasil</p>
            <p class="text-center text-2xl font-semibold mt-3">Booking Code</p>
            <h3 class="text-center text-2xl font-semibold mt-3">{{ $bookingCode }}</h3>
            <p class="text-center text-gray-600 mt-3">Harap simpan kode pemesanan ini dengan baik. Kode ini akan
                digunakan untuk pengambilan dan pengembalian kendaraan.</p>
        </div>

    </div>
</x-guest-layout>
