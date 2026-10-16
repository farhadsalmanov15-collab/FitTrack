@extends('layouts.guest')
@section('title', 'Login')
@section('content')
<div class="card shadow-sm">
    <div class="card-body p-4">
        <h4 class="mb-4">Login</h4>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <p class="text-center mt-3 mb-0">No account? <a href="{{ route('register') }}">Register</a></p>
    </div>
</div>
@endsection