@extends('layouts.main')

@section('content')
<h2>Hello {{ auth()->user()->username }}</h2>
@endsection