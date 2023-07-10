@extends('layouts.main')

@section('content')
    <h2 class="text-center">List Deleted</h2>
    <hr>
    <div class="text-end">
        <a href="/categories" class="btn btn-secondary">Back</a>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <table class="table">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAME</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $item)
                    <tr>
                        <td class="fw-bold">{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <a href="/category/{{ $item->slug }}/restore" class="btn btn-info">
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