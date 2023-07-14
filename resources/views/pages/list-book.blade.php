@extends('layouts.utils')

@section('content')
<div class="row">
    <h3 class="text-center mt-3">List Book</h3>
    <hr>
    @foreach ($books as $item)
    <div class="col-lg-3 col-md-4 col-sm-6 my-3">
        <div class="card h-100">
            @if ($item->cover)
            <img src="{{ asset('/storage/cover/'.$item->cover) }}"  class="card-img-top img-fluid" alt="{{ $item->title }}">
            @else
            <img src="{{ asset('/images/notfound.png') }}"  class="card-img-top img-fluid" alt="{{ $item->title }}">
            @endif
            <div class="card-body">
              <h5 class="card-title">{{ $item->book_code }}</h5>
              <p class="card-text fs-5">{{ $item->title }}</p>
              <p class="text-end fw-bold fs-6 {{ ($item->status == 'in stock') ? 'text-success' : 'text-danger' }}">
                {{ $item->status }}
              </p>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection