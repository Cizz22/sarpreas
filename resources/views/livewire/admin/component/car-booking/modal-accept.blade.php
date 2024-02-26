<div class="p-4">
    <div class="flex justify-between">
        <h5 class="text-lg font-weight-bold">Apakah anda yakin ingin {{ $type == 'accept' ? 'menerima' : 'menolak' }}
            data ini?</h5>
        <button type="button" title="Tutup" wire:click="$emit('closeModal')" class="self-start"><i
                class="cil-x"></i></button>
    </div>
    <hr />

    <form class="w-full max-w-full" wire:submit.prevent="submit" autocomplete="off">
        <div class="flex flex-wrap mb-6">
            @if ($type == 'accept')
                <x-input-label for="name" value="Plat Nomer Kendaraan" />
                <x-text-input id="licence_number" class="block mt-2 w-full" wire:model.lazy="licence_number"
                    type="text" name="licence_number" autofocus />

                @error('licence_number')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            @endif

        </div>


        {{-- <div class="flex flex-wrap mb-2 justify-end mt-3">
            <button wire:loading.attr="disabled"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full" type="submit">
                <span wire:loading.remove>Submit</span>
                <span wire:loading>
                    <i class="fa fa-spinner fa-spin"></i> Submitting...
                </span>
            </button>
        </div> --}}

        <div class="flex flex-wrap mb-2 justify-end mt-3">
            <button wire:loading.attr="disabled"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full" type="submit">
                <span wire:loading.remove>Ya</span>
            </button>

            <button wire:loading.attr="disabled" wire:click="$emit('closeModal')"
                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full ml-2" type="button">
                <span wire:loading.remove>Batal</span>
        </div>

    </form>
</div>
