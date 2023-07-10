@extends('layouts.main')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<h2 class="text-center">Edit Books </h2>
<hr>

<div class="row">
    <div class="col-lg-6">
        <form action="{{ route('books.update', $books->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-2">
                <label for="book_code" class="form-label"><Strong>Code Book</Strong></label>
                <input type="text" class="form-control @error('book_code') is-invalid @enderror" name="book_code"
                    id="book_code" value="{{ old('book_code', $books->book_code) }}" placeholder="Code Book"
                    autofocus readonly>
                @error('book_code')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-2">
                <label for="title" class="form-label"><Strong>Title</Strong></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                    placeholder="Title Book" value="{{ old('title', $books->title) }}" required>
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="images" class="form-label"><Strong>Cover</Strong></label>
                <input type="file" class="form-control @error('images', $books->cover) is-invalid @enderror" name="images" id="images"
                    placeholder="Cover Book">
                @error('images')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="images" class="form-label d-block"><Strong>Current Images</Strong></label>
                @if ($books->cover !=  '')
                    <img src="{{ asset('/storage/cover/'.$books->cover) }}" alt="{{ $books->cover }}" height="200">
                @else
                    <img src="{{ asset('/images/113876_f.jpg') }}" alt="{{ $books->cover }}" height="200">
                @endif
            </div>

            <div class="mb-3">
                <label for="category" class="form-label"><Strong>Category</Strong></label>
                <select name="categories[]" id="category" class="form-select select-multiple" multiple>
                    @foreach($categories as $items)
                        <option value="{{ $items->id }}">{{ $items->name }}</option>
                    @endforeach
                </select>
                @error('categories')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category" class="form-label"><Strong>Current Category</Strong></label>
                <ul>
                    @foreach ($books->categories as $category)
                        <li>{{ $category->name }}</li>
                    @endforeach
                </ul>
                @error('categories')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-4">
                <a href="/books" class="btn btn-secondary me-3">Cancel</a>
                <button type="submit" class="btn btn-primary">Update</button>
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
</script>
@endsection
