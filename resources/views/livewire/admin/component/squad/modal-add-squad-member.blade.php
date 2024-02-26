<div class="p-4">
    <div class="flex justify-between">
        <h5 class="text-lg font-weight-bold">Tambah Squad Member Baru</h5>
        <button type="button" title="Tutup" wire:click="$emit('closeModal')" class="self-start"><i
                class="cil-x"></i></button>
    </div>
    <hr />
    <form class="w-full max-w-full" wire:submit.prevent="submit" autocomplete="off">
        <div class="flex flex-wrap mb-6">
            <x-input-label for="name" value="Member Subnit" />
            <small class="ml-1 text-blue-700 cursor-pointer" wire:click="refreshmembers">(tekan untuk refresh)</small>
            <select
                class="block mt-1 mb-3 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'"
                name="coordinator_id" wire:model.lazy="member_id">
                <option value="">Pilih Member</option>
                @foreach ($members as $c)
                    <option value="{{ $c->member->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
            <hr />

            <small>Bila member belum ada silahkan membuat member baru</small>
            <button onclick="Livewire.emit('openModal', 'admin.component.member.modal-add')"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded" type="button">
                Buat member Baru
            </button>
            @error('member_id')
                <p class="text-red-500 text-xs italic mt-4">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="flex flex-wrap mb-2 justify-end mt-3">
            <button wire:loading.attr="disabled" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full" type="submit">
                <span wire:loading.remove>Submit</span>
                <span wire:loading>
                    <i class="fa fa-spinner fa-spin"></i> Processing...
                </span>
            </button>
        </div>

    </form>
</div>
