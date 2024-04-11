<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true" wire:key="images-{{ $image->filename }}">
    <div class="modal-dialog" role="document" wire:key="images-{{ $image->filename }}">
        <div class="modal-content" wire:key="images-{{ $image->filename }}">
            <div class="modal-header" wire:key="images-{{ $image->filename }}">
                <h5 class="modal-title" id="confirmDeleteModalLabel" wire:key="images-{{ $image->filename }}">Confirm
                    the deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:key="images-{{ $image->filename }}">
                    <span aria-hidden="true" wire:key="images-{{ $image->filename }}">&times;</span>
                </button>
            </div>
            <div class="modal-body" wire:key="images-{{ $image->filename }}">
                Are you sure you want to delete this picture?
            </div>
            <div class="modal-footer" wire:key="images-{{ $image->filename }}">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:key="images-{{ $image->filename }}">No</button>
                <button id="confirmDeleteBtn" class="btn btn-danger delete-image-btn" data-image-id="{{ $image->id }}" data-dismiss="modal" wire:key="images-{{ $image->filename }}">Yes</button>
            </div>
        </div>
    </div>
</div>
