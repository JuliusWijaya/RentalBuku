@extends('layouts.main')

@section('content')
<h2>Hello {{ auth()->user()->username }}</h2>
<hr>
<div class="col-12 col-md-8 col-lg-12">
    <x-rent-log-table :rentlog='$rentlogs'></x-rent-log-table>
</div>
@endsection