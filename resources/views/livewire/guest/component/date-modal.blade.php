<div class="p-4 w-100">
    <div class="flex justify-between">
        <h5 class="text-lg font-weight-bold">Penjadwalan</h5>
        <button type="button" title="Tutup" wire:click="$emit('closeModal')" class="self-start">
            <i class="cil-x"></i></button>
    </div>
    <hr />
    <div class="px-4 mt-4">
        <div id="data_patrol_session">
            <livewire:guest.component.car-calender year="2024" month="5" :day-click-enabled="false" :event-click-enabled="false"
                :drag-and-drop-enabled="false" />
        </div>
    </div>
</div>
