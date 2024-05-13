<div class="p-4 w-100">
    <div class="flex justify-between">
        <h5 class="text-lg font-weight-bold">Gambar</h5>
        <button type="button" title="Tutup" wire:click="$emit('closeModal')" class="self-start">
            <i class="cil-x"></i></button>
    </div>
    <hr />
    <div class="px-4 mt-4">
        <div id="filePreview" class="w-full h-full flex items-center justify-center">
            <img class="w-full" src="{{ $car->image}}" alt="">
        </div>
    </div>
</div>
