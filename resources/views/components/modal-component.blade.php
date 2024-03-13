<dialog id="{{ $modalId }}" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box" data-theme="light">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        {{ $slot }}
    </div>
</dialog>
