@extends('layouts.main')

@section('content')
<div class="row">
    <h2 class="text-center">Rent Logs</h2>
    <hr>
    <div class="col-12 col-md-8 col-lg-12">
        <x-rent-log-table :rentlog='$rentlogs'></x-rent-log-table>
    </div>
</div>
@endsection
