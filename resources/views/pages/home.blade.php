@extends('layouts.utils')

@section('content')
<div class="bg">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/1500x690?library" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="https://source.unsplash.com/1500x690?book" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="https://source.unsplash.com/1500x690?category-book" class="d-block w-100" alt="...">
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
