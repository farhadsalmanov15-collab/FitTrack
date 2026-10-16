@extends('layouts.app')
@section('title', 'Welcome')
@section('content')
<div class="text-center py-5">
    <h1 class="fw-bold text-primary">💪 FitTrack</h1>
    <p class="lead text-muted">Track your workouts, build your strength.</p>
    @guest
    <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-2">Get Started</a>
    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg">Login</a>
    @else
    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">Go to Dashboard</a>
    @endguest
</div>

<div class="row g-4 mt-3">
    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <div class="card-body text-center">
                <h4>🏋️ Log Workouts</h4>
                <p class="text-muted">Record every session with sets, reps and weight.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <div class="card-body text-center">
                <h4>📚 Exercise Library</h4>
                <p class="text-muted">Browse exercises filtered by muscle group.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <div class="card-body text-center">
                <h4>📈 Track Progress</h4>
                <p class="text-muted">View your training history and stats over time.</p>
            </div>
        </div>
    </div>
</div>
@endsection