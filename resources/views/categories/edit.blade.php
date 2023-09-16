@extends('layouts.main')

@section('content')
<h2>Edit Categories {{ $category->name }}</h2>
<div class="row mt-5">
    <div class="col-lg-6">
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name" class="form-label"><strong>Name</strong></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                    placeholder="Name Categories" value="{{ old('name', $category->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary me-2">Update</button>
                <a href="/categories" class="btn btn-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
