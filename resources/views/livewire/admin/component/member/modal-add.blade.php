<div class="p-4">
    <div class="flex justify-between">
        <h5 class="text-lg font-weight-bold">Tambah Member Baru</h5>
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
            <x-input-label for="unit" value="unit" />
            <select
                class="block mt-1 mb-3 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'"
                name="unit_id" wire:model.lazy="unit_id">
                <option value="">Pilih Unit</option>
                @foreach ($units as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
            @error('unit_id')
                <p class="text-red-500 text-xs italic mt-4">
                    {{ $message }}
                </p>
            @enderror
        </div>


        <div class="flex flex-wrap mb-2 justify-end mt-3">
            <button wire:loading.attr="disabled"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full" type="submit">
                <span wire:loading.remove>Submit</span>
                <span wire:loading>
                    <i class="fa fa-spinner fa-spin"></i> Submitting...
                </span>
            </button>
        </div>

    </form>
</div>
