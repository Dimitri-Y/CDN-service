@extends('home')
@section('main.content')
<div class="container">
    @livewire('all-images')
</div>
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
    }

    .image-card img {
        width: 100%;
    }

</style>
@endsection
