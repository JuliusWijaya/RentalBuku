@extends('layouts.main')

@section('content')
<h3>Welcome, {{ auth()->user()->username }}</h3>

<div class="row mt-4">
    <div class="col-lg-4">
        <div class="card-data book">
            <div class="row">
                <div class="col-6">
                    <i class="bi bi-journal-bookmark"></i>
                </div>
                <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                    <div class="card-description">Books</div>
                    <div class="card-count">{{ $books }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card-data category">
            <div class="row">
                <div class="col-6">
                    <i class="bi bi-list-task"></i>
                </div>
                <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                    <div class="card-description">Categories</div>
                    <div class="card-count">{{ $categories }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card-data user">
            <div class="row">
                <div class="col-6">
                    <i class="bi bi-people"></i>
                </div>
                <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                    <div class="card-description">User</div>
                    <div class="card-count">{{ $users }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <h2>#Rent Log</h2>
        <x-rent-log-table :rentlog='$rentlogs'></x-rent-log-table>
    </div>
</div>
@endsection