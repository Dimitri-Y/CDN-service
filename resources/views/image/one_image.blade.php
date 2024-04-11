<div class="col-md-4 mb-3" wire:key="images-{{ $image->filename }}">
    <div class="card" wire:key="images-{{ $image->filename }}">
        <a href="{{ asset($image->url)  }}" data-toggle="lightbox" data-gallery="gallery"
            wire:key="images-{{ $image->filename }}">
            <img src="{{ asset($image->url)  }}" class="card-img-top" alt="{{ $image->filename }}"
                wire:key="images-{{ $image->filename }}">
        </a>
        <div class="card-body" wire:key="images-{{ $image->filename }}">
            <p wire:key="images-{{ $image->filename }}">{{ $image->filename }}</p>
            @if(auth()->check()&& auth()->user()->user_type==="admin")
            <button class="btn btn-danger delete-image-btn" data-toggle="modal" data-target="#confirmDeleteModal"
                data-image-id="{{ $image->id }}" wire:key="images-{{ $image->filename }}">Delete</button>
            <a href="{{ route('image.delete', ['id' => $image->id]) }}" style="display: none;"
                id="delete-link-{{ $image->id }}" wire:key="images-{{ $image->filename }}"></a>
            @endif
        </div>
    </div>
</div>