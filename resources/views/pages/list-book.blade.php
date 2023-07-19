@extends('layouts.utils')

@section('content')
<div class="container">
    <div class="row">
        <h3 class="text-center mt-3">List Book</h3>
        <hr>
        <form action="{{ url('/list-books') }}" method="GET">
            <div class="row mt-3">
                <div class="col-6">
                    <select name="category" id="category" class="form-control">
                        <option value="">-- Select Category --</option>
                        @foreach ($category as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="title" id="title" value="{{ request('title') }}"
                            placeholder="Title Book">
                        <button type="submit" class="btn btn-outline-primary">Search</button>
                    </div>
                </div>
            </div>
        </form>

        @if ($books->count())
        @foreach ($books as $item)
        <div class="col-lg-3 col-md-4 col-sm-6 my-3">
            <div class="card h-100">
                @if ($item->cover)
                <img src="{{ asset('/storage/cover/'.$item->cover) }}" class="card-img-top img-fluid"
                    alt="{{ $item->title }}">
                @else
                <img src="{{ asset('/images/notfound.png') }}" class="card-img-top img-fluid" alt="{{ $item->title }}">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $item->book_code }}</h5>
                    <p class="card-text fs-5">{{ $item->title }}</p>
                    <p class="text-end fw-bold {{ ($item->status == 'in stock') ? 'text-success' : 'text-danger' }}">
                        {{ $item->status }}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="alert alert-danger text-center my-5 col-12">
            Not Found Books
        </div>
        @endif
    </div>
    {{ $books->links() }}
</div>
@endsection
