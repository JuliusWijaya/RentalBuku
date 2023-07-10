@extends('layouts.main')

@section('content')
<h2 class="text-center">Categories</h2>
<hr>
<div class="d-flex justify-content-end">
    <a href="{{ route('categories.create') }}" class="btn btn-primary me-3">Add</a>
    <a href="/category/list-delete" class="btn btn-secondary">View Delete</a>
</div>

<div class="row mt-5 justify-content-start">
    <div class="col-lg-8">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <span class="fw-bold">{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center">NO</th>
                    <th class="text-center">NAME</th>
                    <th class="text-center">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $item)
                <tr>
                    <td class="text-center fw-semibold">{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td class="text-center">
                        <a href="/categories/{{ $item->slug }}/edit" class="btn btn-warning me-2">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#exampleModal{{ $item->slug }}">
                            <i class="bi bi-x-circle"></i>
                        </button>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{ $item->slug }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Categories</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h4>Are You Sure {{ $item->name }} ?</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form action="{{ route('categories.destroy', $item->id) }}" method="POST"
                                    class="d-inline">
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
