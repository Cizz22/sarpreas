<div class="p-4">
    <div class="flex justify-between">
        <h5 class="text-lg font-weight-bold">Data Member</h5>
        <button type="button" title="Tutup" wire:click="$emit('closeModal')" class="self-start"><i
                class="cil-x"></i></button>
    </div>
    <hr />
    <div class="px-4 mt-4">
        <div id="data_member">
            <div class="grid grid-cols-2">
                <div>
                    <p class="font-bold mb-0 mt-2">Nama</p>
                    <p>{{ $member->name }}</p>
                </div>
                <div>
                    <p class="font-bold mb-0 mt-2">No. Handphone</p>
                    <p>{{ $member->no_hp }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="px-4 mt-4">
        <div id="nilai_member">
            <livewire:admin.member-score-table member_id="{{ $member->id }}" />
        </div>
    </div>
</div>
