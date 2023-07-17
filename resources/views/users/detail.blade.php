@extends('layouts.main')

@section('content')
<h2 class="text-center">Detail User {{ $user->username }}</h2>
<hr>
<div class="d-flex justify-content-between">
    <a href="/users" class="btn btn-secondary">Back</a>

    @if ($user->status == 'inactive')
        <a href="/users/{{ $user->slug }}/approve" class="btn btn-primary"
            onclick="return confirm('Serius mau di approved ?')">
            Approved
        </a>
    @endif
</div>

@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show col-10 mt-3" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row mt-4">
    <div class="col-lg-8">
       <div class="mb-3">
            <label for="usename" class="form-label">Username</label>
            <input type="text" class="form-control" value="{{ $user->username }}" readonly>
       </div>
       <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" value="{{ (isset($user->phone)) ? $user->phone : '-' }}" readonly>
       </div>
       <div class="mb-3">
            <label for="address" class="form-label d-block">Address</label>
            <textarea  id="address"  rows="5" class="form-control" style="resize: none;" readonly>{{ $user->address }}</textarea>
       </div>
       <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <input type="text"  id="status" class="form-control" value="{{ $user->status }}" readonly />
       </div>
    </div>
    <div class="mt-3">
        <h3># Rent Logs</h3>
        <hr>
        <x-rent-log-table :rentlog='$rentlogs'></x-rent-log-table>
    </div>
</div>
@endsection