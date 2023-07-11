@extends('layouts.main')

@section('content')
<h2 class="text-center">List Deleted</h2>
<hr>

<div class="text-end">
    <a href="/books" class="btn btn-secondary">Back</a>
</div>

<div class="row mt-4">
    <div class="col-lg-12">
        <table class="table">
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
                @foreach ($books as $item)
                <tr>
                    <td class="fw-bold">{{ $loop->iteration }}</td>
                    <td>{{ $item->book_code }}</td>
                    <td>{{ $item->title }}</td>
                    <td>
                        @foreach ($item->categories as $category)
                            {{ $category->name }}<br>
                        @endforeach
                    </td>
                    <td>{{ $item->status }}</td>
                    <td>
                        <a href="/book/{{ $item->slug }}/restore" class="btn btn-info">
                            <i class="bi bi-arrow-clockwise"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
