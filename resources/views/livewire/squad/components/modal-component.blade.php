<div class="p-4">
    <div class="flex justify-between">
        <h5 class="text-lg font-weight-bold">Konfirmasi {{ $tugas }}</h5>
        <button type="button" title="Tutup" wire:click="$emit('closeModal')" class="self-start"><i
                class="cil-x"></i></button>
    </div>
    <hr />
    <form class="w-full max-w-full" method="POST" action="{{ route('dashboard.squad.start.patrol') }}"
        autocomplete="off">
        <div class="flex flex-wrap mb-6">
            @csrf
            <input type="hidden" name="type" value="{{$type}}">
            <input type="hidden" name="interval_schedule" value="{{ $interval_schedule }}">
            <x-input-label for="name" />
            <p class="mb-5">Pilih anggota {{ $tugas }}</p>
            <select name="members[]" id="names" multiple="multiple">
                @foreach ($squad->squadMember as $c)
                    <option value="{{ $c->member->id }}">{{ $c->member->name }}</option>
                @endforeach
            </select>

            @error('names')
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

    <script>
        $(document).ready(function() {
            $('#names').select2({
                placeholder: 'Pilih satu atau lebih anggota',
                allowClear: true,
                closeOnSelect: false
            });
        });
    </script>
</div>
