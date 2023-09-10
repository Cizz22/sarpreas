<div class="p-4 w-100">
    <div class="flex justify-between">
        <h5 class="text-lg font-weight-bold">Subunit Member</h5>
        <button type="button" title="Tutup" wire:click="$emit('closeModal')" class="self-start">
            <i class="cil-x"></i></button>
    </div>
    <hr />
    <div class="px-4 mt-4">
        <div id="data_subsunit_members">
            <livewire:admin.subunit-member-table unit_id="{{ $unit_id }}" subunit_id="{{ $subunit_id }}" />
        </div>
    </div>
</div>
