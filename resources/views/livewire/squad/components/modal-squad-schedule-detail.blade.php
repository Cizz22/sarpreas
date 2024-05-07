<div class="p-4 w-100">
    <div class="flex justify-between">
        <h5 class="text-lg font-weight-bold">Squad Schedule Report</h5>
        <button type="button" title="Tutup" wire:click="$emit('closeModal')" class="self-start">
            <i class="cil-x"></i></button>
    </div>
    <hr />
    <div class="px-4 mt-4">
        <div id="data_subsunit_members">
            <livewire:admin.report-s-k-k-table reguInput="{{ $reguInput }}" dateInput="{{ $dateInput }}"
                shiftInput="{{ $shiftInput }}" />
        </div>
    </div>
</div>
