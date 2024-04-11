<div class="row " id="image-container">
    @if(isset($images))
    @foreach($images as $image)
    @include('image.one_image')
    @include('image.modal_delete_image')
    @endforeach
    @endif
    @if ($images->hasMorePages())
    <button wire:click='loadMore' wire:loading.attr="disabled" class="btn btn-primary">Load More</button>
    @endif

    @include('image.modal_delete_success')
</div>
