<div class="p-4">
    <div class="flex justify-between">
        <h5 class="text-lg font-weight-bold">Tambah Kendaraan</h5>
        <button type="button" title="Tutup" wire:click="$emit('closeModal')" class="self-start"><i
                class="cil-x"></i></button>
    </div>
    <hr />
    <form class="w-full max-w-full" wire:submit.prevent="submit" autocomplete="off">
        <div class="flex flex-wrap mb-6">
            <x-input-label for="name" value="Nama" />

            <x-text-input id="name" class="block mt-2 w-full" wire:model.lazy="name" type="text" name="name"
                autofocus />

            @error('name')
                <p class="text-red-500 text-xs italic mt-4">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="flex flex-wrap mb-6">
            <x-input-label for="name" value="Kapasitas" />

            <x-text-input id="name" class="block mt-2 w-full" wire:model.lazy="capacity" type="text" name="capacity"
                autofocus />

            @error('capacity')
                <p class="text-red-500 text-xs italic mt-4">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="flex flex-wrap mb-6">
            <x-input-label for="name" value="Tipe Kendaraan" />

            <select
                class="block mt-1 mb-3 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'"
                name="coordinator_id" wire:model.lazy="vehicle_type">
                <option value="">Pilih Tipe Kendaraan</option>
                <option value="Mobil">Mobil</option>
                <option value="Bus">Bus</option>
            </select>

            @error('vehicle_type')
                <p class="text-red-500 text-xs italic mt-4">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
            <div class="md:col-span-5">
                <label for="full_name">Gambar Kendaraan</label>
                <div
                    class="relative border-2 rounded-md px-4 py-3 bg-white flex items-center justify-between hover:border-blue-500 transition duration-150 ease-in-out">
                    <input type="file" id="fileAttachment" name="image" wire:model="image"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">

                    <div class="flex items-center" style="display: flex;" id="fileInfo">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span class="ml-2 text-sm text-gray-600">Choose a file</span>
                    </div>
                    <span class="text-sm text-gray-500">Max file size: 1MB</span>
                </div>
                @if ($image)
                    <div id="filePreview" class="w-full h-full flex items-center justify-center">
                        <img class="w-full" src="{{ $image->temporaryUrl() }}" alt="">
                    </div>
                @endif
            </div>
            @error('image')
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
                    <i class="fa fa-spinner fa-spin"></i> Processing...
                </span>
            </button>
        </div>

    </form>
</div>
