@extends('layouts.main')

@section('content')
<h2 class="text-center">List User Non Active</h2>
<hr>
<div class="text-end">
    <a href="/users" class="btn btn-secondary">Back</a>
</div>

@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show col-10 mt-3" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row justify-content-center mt-4">
    <div class="col-md-8 col-lg-10">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>USERNAME</th>
                    <th>PHONE</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inactive as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ (isset($user->phone)) ? $user->phone : '-' }}</td>
                    <td>
                        <a href="/users/{{ $user->slug }}/detail" class="btn btn-warning me-2">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                        <a href="#" class="btn btn-info">
                            <i class="bi bi-app-indicator"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection