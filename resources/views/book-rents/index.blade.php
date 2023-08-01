@extends('layouts.main')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="row">
    <div class="col-12 col-md-6 col-lg-6 offset-md-3">
        <h2 class="text-center">Book Rent</h2>
        <hr>

        @if(Session::has('status'))
        <div class="alert {{ Session::get('alert-class') }}">
            <strong>{{ Session::get('status') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card mt-5">
            <div class="card-body">
                <form action="{{ route('book-rents.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="user_id" class="form-label d-block">Username</label>
                        <select name="user_id" id="user_id"
                            class="form-select @error('user_id') is-invalid @enderror user-box">
                            <option value="">Choose User</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->username }}</option>
                            @endforeach
                        </select>
                        @error ('user_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="book_id" class="form-label">Book Title</label>
                        <select name="book_id" id="book_id"
                            class="form-select @error('book_id') is-invalid @enderror book-box">
                            <option value="">Choose Book</option>
                            @foreach ($books as $book)
                            <option value="{{ $book->id }}">{{ $book->title }}</option>
                            @endforeach
                        </select>
                        @error ('book_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('.user-box').select2();
        $('.book-box').select2();
    });

</script>
@endsection
