@extends('home')
@section('main.content')
<div>
    <form action="{{ route('image.upload') }}" method="POST" enctype="multipart/form-data" class="justify-content-center">
        {{ csrf_field() }}
        <div class=" form-group">
            <div class="input-group mb-3 ">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile02" multiple accept="image/jpeg, image/png" name="images[]">
                    <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                </div>
            </div>
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
            @error('images')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mt-3">
            <ul id="selectedFiles" class="list-group"></ul>
        </div>
</div>
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<button class="btn btn-default btn-outline-secondary btn-lg" type="submit">
    Upload image
</button>
</form>

</div>
<script>
    document.getElementById('inputGroupFile02').addEventListener('change', function(event) {
        var files = event.target.files;
        var selectedFilesList = document.getElementById('selectedFiles');
        selectedFilesList.innerHTML = ''; // Очистити список перед виведенням нових файлів
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var fileNameItem = document.createElement('li');
            fileNameItem.classList.add('list-group-item');
            fileNameItem.textContent = file.name;
            selectedFilesList.appendChild(fileNameItem);
        }
    });

</script>
@endsection
