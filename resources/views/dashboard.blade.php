@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>My Dashboard</h2>
    <a href="{{ route('sessions.create') }}" class="btn btn-primary">+ Log a Workout</a>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <h3 class="text-primary">{{ $sessionsThisMonth }}</h3>
                <p class="mb-0 text-muted">Workouts this month</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <h3 class="text-primary">{{ $totalSessions }}</h3>
                <p class="mb-0 text-muted">Total sessions</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <h3 class="text-primary">{{ $lastSession ? $lastSession->date : '-' }}</h3>
                <p class="mb-0 text-muted">Last session</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <h3 class="text-primary">{{ $streak }}d</h3>
                <p class="mb-0 text-muted">Streak</p>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header">Recent Sessions</div>
    <div class="card-body p-0">
        <table class="table mb-0">
            <thead class="table-light">
                <tr>
                    <th>Date</th>
                    <th>Exercises</th>
                    <th>Sets</th>
                    <th>Notes</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentSessions as $session)
                <tr>
                    <td>{{ $session->date }}</td>
                    <td>{{ $session->workoutSets->pluck('exercise.name')->unique()->join(', ') }}</td>
                    <td>{{ $session->workoutSets->count() }}</td>
                    <td>{{ $session->notes ?? '-' }}</td>
                    <td><a href="{{ route('sessions.show', $session) }}" class="btn btn-sm btn-outline-primary">View</a></td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted">No sessions yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection