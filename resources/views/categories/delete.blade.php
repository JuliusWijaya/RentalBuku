@extends('layouts.main')

@section('content')
<h2>Delete Categories</h2>
<div class="row mt-5">
    <div class="col-lg-6">
        <h3 class="mb-3">Are You Sure {{ $category->name }} ?</h3>
        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline me-3">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="bi bi-x-circle"></i>
            </button>
        </form>
        <a href="/categories" class="btn btn-primary">
            <i class="bi bi-arrow-bar-left"></i>
        </a>
    </div>
</div>
@endsection
