@extends('layouts.index')

@section('content')
<div class="main d-flex flex-column justify-content-center align-items-center">
    @if (session('status'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="login-box">
        <h3 class="text-center mt-0">Login</h3>
        <form action="{{ route('authenticate') }}" method="POST">
            @csrf
            <div>
                <label for="username">Username</label>
                <input type="text" name="username" id="username"
                    class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required
                    autofocus>
                @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password"
                    class="form-control @error('password') is-invalid @enderror" required>
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary form-control">Login</button>
        </form>
        <div class="text-center mt-2">
            Don't have an account <a href="/register" class="text-decoration-none">Sign Up</a>
        </div>
    </div>
</div>
@endsection
