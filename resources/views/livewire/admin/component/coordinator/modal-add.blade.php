<div class="p-4">
    <div class="flex justify-between">
        <h5 class="text-lg font-weight-bold">Tambah Koordinator Baru</h5>
        <button type="button" title="Tutup" wire:click="$emit('closeModal')" class="self-start"><i
                class="cil-x"></i></button>
    </div>
    <hr />
    <form class="w-full max-w-full" wire:submit.prevent="submit" autocomplete="off">
        <div class="flex flex-wrap mb-6">
            <x-input-label for="name" value="Nama" />

            <x-text-input id="name" class="block mt-2 w-full" wire:model.lazy="name" type="text"
                name="name" autofocus />

            @error('name')
                <p class="text-red-500 text-xs italic mt-4">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="flex flex-wrap mb-6">
            <x-input-label for="name" value="No Handphone" />
            <x-text-input id="no_hp" class="block mt-2 w-full" wire:model.lazy="no_hp" type="text"
                name="no_hp" autofocus />

            @error('no_hp')
                <p class="text-red-500 text-xs italic mt-4">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="flex flex-wrap mb-2 justify-end mt-3">
            <button wire:loading.attr="disabled" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full" type="submit">
                <span wire:loading.remove>Submit</span>
                <span wire:loading>
                    <i class="fa fa-spinner fa-spin"></i> Processing...
                </span>
            </button>
        </div>

    </form>
</div>
