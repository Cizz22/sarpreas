<div class="p-4">
    <div class="flex justify-between">
        <h5 class="text-lg font-weight-bold">Apakah anda yakin?</h5>
        <button type="button" title="Tutup" wire:click="$emit('closeModal')" class="self-start"><i
                class="cil-x"></i></button>
    </div>
    <hr />

    {{-- <form class="w-full max-w-full" wire:submit.prevent="submit" autocomplete="off">
        <div class="grid grid-col-1">
            <div class="flex flex-wrap mb-6">
                <x-input-label for="name" value="Keterangan Tambahan(jika ada)" />
                <div class="mt-1">
                    <textarea wire:model="keterangan" rows="3"
                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                        placeholder="Keterangan tambahan"></textarea>
                </div>
                @error('keterangan')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

            </div>
            <div class="flex flex-wrap mb-2 justify-end mt-3">
                <button wire:loading.attr="disabled" type="submit"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full" type="submit">
                    <span wire:loading.remove>Ya</span>
                </button>
                <button wire:loading.attr="disabled" wire:click="$emit('closeModal')"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full ml-2" type="button">
                    <span wire:loading.remove>Batal</span>
            </div>
        </div>

    </form> --}}
    <form class="w-full max-w-full" wire:submit.prevent="submit" autocomplete="off">
        <div class="flex flex-wrap mb-6">
            <x-input-label for="name" value="Keterangan Tambahan (jika ada)" />

            <textarea wire:model="keterangan" rows="3"
                class="rounded-md w-full shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                placeholder="Keterangan tambahan"></textarea>

            @error('keterangan')
                <p class="text-red-500 text-xs italic mt-4">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="flex flex-wrap mb-2 justify-end mt-3">
            <button wire:loading.attr="disabled" type="submit"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full" type="submit">
                <span wire:loading.remove>Ya</span>
            </button>
            <button wire:loading.attr="disabled" wire:click="$emit('closeModal')"
                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full ml-2" type="button">
                <span wire:loading.remove>Batal</span>
        </div>

    </form>
</div>
