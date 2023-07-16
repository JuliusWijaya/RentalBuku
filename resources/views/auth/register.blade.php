@extends('layouts.index')

@section('content')
<div class="main d-flex flex-column justify-content-center align-items-center">
    <div class="register-box">
        <h3 class="text-center mt-0">Register</h3>
        <form action="{{ route('registerAction') }}" method="POST">
            @csrf
            <div>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" required autofocus>
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="phone">Phone</label>
                <input type="number" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror">
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="address">Address</label>
                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" required style="resize: none;"></textarea>
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary form-control">Register</button>
        </form>
        <div class="text-center mt-2">
            Already have an account <a href="/login" class="text-decoration-none">Sign In</a>
        </div>
    </div>
</div>
@endsection