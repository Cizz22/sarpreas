<div class="p-4">
    <div class="flex justify-between">
        <h5 class="text-lg font-weight-bold">{{ $title }}</h5>
        <button type="button" title="Tutup" wire:click="$emit('closeModal')" class="self-start"><i
                class="cil-x"></i></button>
    </div>
    <hr />
    <form class="w-full max-w-full" wire:submit.prevent="submit" autocomplete="off">
            {{ $slot }}
        <div class="flex flex-wrap mb-2 justify-end mt-3">
            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full" type="submit">
                Save
            </button>
        </div>

    </form>
</div>
