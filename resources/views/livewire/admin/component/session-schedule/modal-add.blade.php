<div class="p-4">
    <div class="flex justify-between">
        <h5 class="text-lg font-weight-bold">Buat Sesi {{ $unit_name }} Baru</h5>
        <button type="button" title="Tutup" wire:click="$emit('closeModal')" class="self-start">
            <i class="cil-x"></i></button>
    </div>
    <hr />
    <form class="w-full max-w-full" wire:submit.prevent="submit" autocomplete="off">
        <div class="flex flex-wrap mb-3">
            <x-input-label for="name" value="Member 1" />
            <select
                class="block mt-1 mb-3 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'"
                name="member_1" wire:model.lazy="member_1">
                <option value="">Pilih Member 1</option>
                @foreach ($members as $c)
                    <option value="{{ $c->member->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
            <hr />
            @error('member_1')
                <p class="text-red-500 text-xs italic mt-4">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="flex flex-wrap mb-6">
            <x-input-label for="name" value="Member 2" />
            <select
                class="block mt-1 mb-3 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'"
                name="member_2" wire:model.lazy="member_2">
                <option value="">Pilih Member 2</option>
                @foreach ($members as $c)
                    <option value="{{ $c->member->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
            <hr />

            <small>Bila member belum ada silahkan membuat member baru<span>
                    <small class="ml-1 text-blue-700 cursor-pointer" wire:click="refreshmembers">(tekan untuk
                        refresh)</small>
                </span></small>
            <button onclick="Livewire.emit('openModal', 'admin.component.member.modal-add')"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded" type="button">
                Buat member Baru
            </button>
            @error('member_2')
                <p class="text-red-500 text-xs italic mt-4">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="flex flex-wrap mb-3">
            <x-input-label for="name" value="Shift" />
            <select
                class="block mt-1 mb-3 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'"
                name="shift" wire:model.lazy="shift">
                <option value="">Pilih Sesi</option>
                <option value="Pagi">Pagi</option>
                <option value="Siang">Siang</option>
                <option value="Malam">Malam</option>
            </select>

            @error('shift')
                <p class="text-red-500 text-xs italic mt-4">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="flex flex-wrap mb-6">
            <x-input-label for="date" value="Tanggal Patroli" />
            <x-text-input id="date" class="block mt-2 w-full" wire:model.lazy="date" type="date"
                name="date" autofocus />

            @error('date')
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
