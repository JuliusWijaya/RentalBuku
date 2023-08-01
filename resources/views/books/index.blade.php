@extends('layouts.main')

@section('content')
{{-- DataTables --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">

<h2 class="text-center">Book</h2>
<hr>

<div class="text-end">
    <a href="{{ route('books.create') }}" class="btn btn-primary me-2">Add Book</a>
    <a href="/book/list-delete" class="btn btn-secondary">View Delete</a>
</div>

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show col-10 mt-3" role="alert">
    <strong>{{ session('success') }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="row px-5 mt-4">
    <div class="col-sm-12 col-md-8 col-lg-11">
        <table class="table table-hover" id="example">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>CODE BOOK</th>
                    <th>TITLE</th>
                    <th>CATEGORY</th>
                    <th>STATUS</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                <tr>
                    <td class="fw-bold">{{ $loop->iteration }}</td>
                    <td>{{ $book->book_code }}</td>
                    <td>{{ $book->title }}</td>
                    <td>
                        @foreach ($book->categories as $category)
                            {{ $category->name }} <br>
                        @endforeach
                    </td>
                    <td 
                    class="{{ ($book->status == 'in stock') ? 'text-success fw-semibold' : 'text-danger fw-semibold' }}">    {{ $book->status }}
                    </td>
                    <td>
                        <a href="/books/{{ $book->slug }}/edit" class="btn btn-warning me-2">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#exampleModal{{ $book->slug }}">
                            <i class="bi bi-x-circle"></i>
                        </button>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{ $book->slug }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Categories</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h4>Are You Sure {{ $book->title }} ?</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    new DataTable('#example');
</script>
@endsection
