@extends('home')
@section('main.content')
<div class="container">
    <div class="row">
        @if(isset($images))
        @foreach($images as $image)
        <div class="col-md-4 mb-3">
            <div class="card">
                <a href="{{ asset($image->url)  }}" data-toggle="lightbox" data-gallery="gallery">
                    <img src="{{ asset($image->url)  }}" class="card-img-top" alt="{{ $image->filename }}">
                </a>
                <div class="card-body">
                    <p>{{ $image->filename }}</p>
                    @if(auth()->check()&& auth()->user()->user_type==="admin")
                    <button class="btn btn-danger delete-image-btn" data-toggle="modal" data-target="#confirmDeleteModal" data-image-id="{{ $image->id }}">Delete</button>
                    <a href="{{ route('image.delete', ['id' => $image->id]) }}" style="display: none;" id="delete-link-{{ $image->id }}"></a>
                    @endif
                </div>

            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>
@include('image.modal_delete_image');
@include('image.modal_delete_success');
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $('.delete-image-btn').click(function() {
            var imageId = $(this).data('image-id');
            $('#confirmDeleteBtn').data('image-id', imageId);
        });

        $('#confirmDeleteBtn').click(function() {
            var imageId = $(this).data('image-id');
            $.ajax({
                url: '{{ route("image.delete") }}'
                , type: 'DELETE'
                , data: {
                    id: imageId
                    , _token: '{{ csrf_token() }}'
                }
                , success: function(result) {
                    console.log(result);
                    $('#successModal').modal('show');
                }
                , error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
            console.log("Deleting image...");
        });
    });

</script>
@endsection
@section('styles')
<style>
    .image-card {
        width: 280px;
        height: auto;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 20px;
        /* Простір між карточками */
    }

    .image-card img {
        width: 100%;
    }

</style>
@endsection
