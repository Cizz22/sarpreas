<div class="p-4">
    <div class="flex justify-between">
        <h5 class="text-lg font-weight-bold">Edit</h5>
        <button type="button" title="Tutup" wire:click="$emit('closeModal')" class="self-start"><i
                class="cil-x"></i></button>
    </div>
    <hr />
    <form class="w-full max-w-full" wire:submit.prevent="submit" autocomplete="off">
        @foreach ($data as $d)
            <div class="flex flex-wrap mb-6">
                <x-input-label for="{{ $d[0] }}" value="{{ $d[1] }}" />

                @switch($d[2])
                    @case('text')
                        <x-text-input id="{{ $d[0] }}" class="block mt-2 w-full" wire:model.lazy="{{ $d[0] }}"
                            type="text" name="{{ $d[0] }}" autofocus />
                    @break

                    @case('select')
                        <select
                            class="block mt-1 mb-3 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'"
                            name="{{ $d[0] }}" wire:model="{{ $d[0] }}">
                            <option value="">Pilih {{ $d[1] }}</option>
                            @foreach ($d[3] as $c)
                                @switch($d[4])
                                    @case('subunit')
                                        <option value="{{ $c['member']['id'] }}">{{ $c['member']['name'] }}</option>
                                    @break
                                    @case('instrument')
                                    <option value="{{ $c['id'] }}">{{ $c['name'] }}</option>
                                    @break

                                    @default
                                @endswitch
                            @endforeach
                        </select>
                    @break

                    @default
                @endswitch


                @error($d[0])
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>
        @endforeach
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
