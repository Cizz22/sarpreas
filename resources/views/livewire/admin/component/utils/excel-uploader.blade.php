<div class="p-4">
    <div class="flex justify-between">
        <h5 class="text-lg font-weight-bold">Upload Excel untuk Tambah Unit Baru</h5>
        <button type="button" title="Tutup" wire:click="$emit('closeModal')" class="self-start"><i
                class="cil-x"></i></button>
    </div>
    <hr />
    <form class="w-full max-w-full" wire:submit.prevent="submit" autocomplete="off">
        <div class="flex flex-wrap mb-6">
            <x-input-label for="name" value="Upload File Excel" />
            <input type="file" wire:model="excel" name="excel">

            @error('excel')
                <p class="text-red-500 text-xs italic mt-4">
                    {{ $message }}
                </p>
            @enderror
            {{-- Make div for excel row detail information --}}
            @if ($excel)
                <div class="mt-4">
                    <h5 class="text-lg font-weight-bold">Detail Excel</h5>
                    <hr />
                    <div class="flex flex-wrap mb-6">
                        <x-input-label for="name" value="Nama File" />
                        <input type="text" value="{{ $excel->getClientOriginalName() }}" disabled>
                    </div>
                    <div class="flex flex-wrap mb-6">
                        <x-input-label for="name" value="Ukuran File" />
                        <input type="text" value="{{ $excel->getSize() }}" disabled>
                    </div>
                    <div class="flex flex-wrap mb-6">
                        <x-input-label for="name" value="Tipe File" />
                        <input type="text" value="{{ $excel->getMimeType() }}" disabled>
                    </div>
                    <div class="flex flex-wrap mb-6">
                        <x-input-label for="name" value="Jumlah Baris" />
                        <input type="text" value="{{ $rows }}" disabled>
                    </div>
                    <div class="flex flex-wrap mb-6">
                        <x-input-label for="name" value="Jumlah Kolom" />
                        <input type="text" value="{{ $cols }}" disabled>
                    </div>
                </div>
            @endif
            {{-- Div for detail excel row that user must have on their excel file based on $data --}}
            <div class="mt-3">
                <h5 class="text-lg font-weight-bold">File Excel Harus memiliki row berikut</h5>
                <hr />
                @foreach ($data as $a)
                    <div class="flex flex-wrap mb-6">
                        <x-input-label for="name" value="{{ $a }}" />
                    </div>
                @endforeach
            </div>

        </div>
        <div class="flex flex-wrap mb-2 justify-end mt-3">
            <button wire:loading.attr="disabled"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full" type="submit">
                <span wire:loading.remove>Submit</span>
                <span wire:loading>
                    <i class="fa fa-spinner fa-spin"></i> Processing...
                </span>
            </button>
        </div>
    </form>
</div>
