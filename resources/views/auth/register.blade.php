@extends('layouts.index')

@section('content')
<div class="main d-flex justify-content-center align-items-center">
    <div class="login-box">
        <h3 class="text-center mt-0">Register</h3>
        <form action="" method="POST">
            @csrf
            <div>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div>
                <label for="password">Phone</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div>
                <label for="password">Address</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary form-control">Register</button>
        </form>
        <div class="text-center mt-2">
            <a href="/login" class="text-decoration-none">Sign In</a>
        </div>
    </div>
</div>
@endsection