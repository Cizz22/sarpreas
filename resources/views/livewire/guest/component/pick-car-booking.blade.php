<div class="p-4">
    <div class="flex justify-between">
        <h5 class="text-lg font-weight-bold">Peminjaman Kendaraan</h5>
        <button type="button" title="Tutup" wire:click="$emit('closeModal')" class="self-start"><i
                class="cil-x"></i></button>
    </div>
    <hr />

    <div class="flex justify-center mt-3">
        <a href="{{route('peminjaman.list-kendaraan')}}" class="inline-block">
            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-full mr-2 mb-2">
                Form Peminjaman Kendaraan
            </button>
        </a>
        <a href="{{route('peminjaman.form-borrow-return')}}" class="inline-block">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-full mb-2">
                Form Pengambilan/Pengembalian Kendaraan
            </button>
        </a>
    </div>




</div>
