@extends('layouts.main')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<h3 class="text-center">Add New Book</h3>
<hr>
<div class="row">
    <div class="col-lg-6">
        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-2">
                <label for="book_code" class="form-label"><Strong>Code Book</Strong></label>
                <input type="text" class="form-control @error('book_code') is-invalid @enderror" name="book_code"
                    id="book_code" value="{{ old('book_code') }}" placeholder="Code Book" required autofocus>
                @error('book_code')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-2">
                <label for="title" class="form-label"><Strong>Title</Strong></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                    placeholder="Title Book" value="{{ old('title') }}" required>
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="images" class="form-label"><Strong>Cover</Strong></label>
                <img class="img-preview img-fluid col-sm-3 mb-3">
                <input type="file" class="form-control @error('images') is-invalid @enderror" name="images" id="images"
                    placeholder="Cover Book" onchange="previewImage()">
                @error('images')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category" class="form-label"><Strong>Category</Strong></label>
                <select name="categories[]" id="category" class="form-select select-multiple" multiple>
                    @foreach ($categories as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('images')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-4">
                <a href="/books" class="btn btn-secondary me-3">Cancel</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('.select-multiple').select2();
    });

    function previewImage(){
        const image = document.getElementById('images');
        const imgPreview = document.querySelector('.img-preview')

        imgPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
@endsection
