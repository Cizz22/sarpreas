<div class="p-4">
    <div class="flex justify-between">
        <h5 class="text-lg font-weight-bold">Apakah anda yakin ingin menghapus data ini?</h5>
        <button type="button" title="Tutup" wire:click="$emit('closeModal')" class="self-start"><i
                class="cil-x"></i></button>
    </div>
    <hr />

    <div class="flex flex-wrap mb-2 justify-end mt-3">
        <button wire:loading.attr="disabled" wire:click="delete"
            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full" type="submit">
            <span wire:loading.remove>Hapus</span>
        </button>
        <button wire:loading.attr="disabled" wire:click="$emit('closeModal')"
            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full ml-2" type="button">
            <span wire:loading.remove>Batal</span>
    </div>


</div>
