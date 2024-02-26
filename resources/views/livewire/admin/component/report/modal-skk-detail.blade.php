<div class="p-4">
    <div class="flex justify-between">
        <h5 class="text-lg font-weight-bold">Laporan</h5>
        <button type="button" title="Tutup" wire:click="$emit('closeModal')" class="self-start"><i
                class="cil-x"></i></button>
    </div>
    <hr />
    <div class="px-4 mt-4">
        <div id="nilai_member">
            <livewire:admin.report-s-k-k-detail-table session_schedule_id="{{ $session_schedule_id }}" />
        </div>
    </div>
</div>
