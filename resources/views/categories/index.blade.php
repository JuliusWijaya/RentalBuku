@extends('layouts.main')

@section('content')
<h1>Categories</h1>

<div class="d-flex justify-content-end">
    <a href="{{ route('categories.create') }}" class="btn btn-primary me-3">Add</a>
    <a href="#" class="btn btn-secondary">View Delete</a>
</div>
<div class="row mt-5 justify-content-start">
    <div class="col-lg-8">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
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
                    
                        <form action="{{ route('categories.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                             onclick="return confirm('Are You Sure {{ $item->name }} ?')">
                                <i class="bi bi-x-circle"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
