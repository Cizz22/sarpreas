<div class="p-4">
    <div class="flex justify-between">
        <h5 class="text-lg font-weight-bold">Passcode Koordinator</h5>
        <button type="button" title="Tutup" wire:click="$emit('closeModal')" class="self-start"><i
                class="cil-x"></i></button>
    </div>
    <hr />
    <form class="w-full max-w-full" wire:submit.prevent="submit" autocomplete="off">
        <div class="flex flex-wrap mb-6">
            <x-input-label for="name" value="Password Admin" />

            <x-text-input id="name" class="block mt-2 w-full" wire:model.defer="password" type="password"
                name="password" autofocus />

            @error('password')
                <p class="text-red-500 text-xs italic mt-4">
                    {{ $message }}
                </p>
            @enderror
        </div>
    </form>
    <hr />
    <div class="px-4 mt-4">
        <div id="data_tim">
            <div class="grid grid-cols-2">
                <div>
                    <p class="font-bold mb-0 mt-2">Nama</p>
                    <p>{{ $coordinator->name }}</p>
                </div>
                <div>
                    <p class="font-bold mb-0 mt-2">Passcode</p>
                    <p>{{ $passcode }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
