<div class="p-4">
    <div class="flex justify-between">
        <h5 class="text-lg font-weight-bold">Penilaian</h5>
        <button type="button" title="Tutup" wire:click="$emit('closeModal')" class="self-start"><i
                class="cil-x"></i></button>
    </div>

    <hr />
    <form class="w-full max-w-full" wire:submit.prevent="submit" autocomplete="off">
        @csrf
        <div class="">
            <div class="border-b border-gray-900/10 pb-12">
                @foreach ($instruments as $index => $ins)
                    <fieldset class="mb-4">
                        <p class="text-sm leading-6 text-black">{{ $ins->instrument }}</p>
                        <div class="">
                            <div class="flex items-center gap-x-3">
                                <input id="{{ 'instrument-' . $index }}" name="{{ 'instrument' . $index }}"
                                    type="radio" value="25" wire:model.defer="{{ 'instrument' . $index }}"
                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                <label for="{{ 'instrument' . $index }}"
                                    class="block text-sm font-medium leading-6 text-gray-900">Baik</label>
                            </div>
                            <div class="flex items-center gap-x-3">
                                <input id="{{ 'instrument-' . $index }}" name="{{ 'instrument-' . $index }}"
                                    type="radio" wire:model.defer="{{ 'instrument' . $index }}" value="0"
                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                <label for="{{ 'instrument' . $index }}"
                                    class="block text-sm font-medium leading-6 text-gray-900">Jelek</label>
                            </div>
                        </div>
                    </fieldset>
                    @error('instrument' . $index)
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                    @enderror
                @endforeach
                <fieldset class="mb-4">
                    <p class="text-sm leading-6 text-black">Presensi Member</p>
                    <div class="">
                        <div class="flex items-center gap-x-3">
                            <input id="presensi" name="presensi"
                                type="radio" value="hadir" wire:model.defer="presensi"
                                class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            <label for="presensi"
                                class="block text-sm font-medium leading-6 text-gray-900">Hadir</label>
                        </div>
                        <div class="flex items-center gap-x-3">
                            <input id="presensi" name="presensi"
                                type="radio" wire:model.defer="presensi" value="izin"
                                class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            <label for="presensi"
                                class="block text-sm font-medium leading-6 text-gray-900">Izin</label>
                        </div>
                        <div class="flex items-center gap-x-3">
                            <input id="presensi" name="presensi"
                                type="radio" wire:model.defer="presensi" value="alpa"
                                class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            <label for="presensi"
                                class="block text-sm font-medium leading-6 text-gray-900">Tidak Hadir</label>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="flex flex-wrap mb-2 justify-end mt-3">
            <button wire:loading.attr="disabled" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full" type="submit">
                <span wire:loading.remove>Submit</span>
                <span wire:loading>
                    <i class="fa fa-spinner fa-spin"></i> Submitting...
                </span>
            </button>
        </div>
    </form>
</div>
