@extends('home')
@section('main.content')
<div class="container">
    <div class="row">
        @if(isset($images))
        @foreach($images as $image)
        <div class="col-md-4 mb-3">
            <a href="{{ asset($image->url) }}" data-toggle="lightbox" data-gallery="gallery">
                <img src="{{ asset($image->url) }}" class="img-fluid">
            </a>
        </div>
        @endforeach
        @endif
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplelightbox/2.1.0/simple-lightbox.min.js"></script>
<script>
    $(document).ready(function() {
        var gallery = new SimpleLightbox('.gallery a', {});
    });

</script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/simplelightbox/2.1.0/simple-lightbox.min.css" rel="stylesheet">
@endsection
