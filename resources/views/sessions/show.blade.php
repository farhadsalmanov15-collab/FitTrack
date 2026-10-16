
@extends('layouts.app')
@section('title', 'Session Detail')
@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between">
        <span>Session — {{ $session->date }}</span>
        <div class="d-flex gap-2">
            <a href="{{ route('sessions.edit', $session) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
            <form method="POST" action="{{ route('sessions.destroy', $session) }}">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')">Delete</button>
            </form>
        </div>
    </div>
    <div class="card-body">
        @if($session->notes)
        <p class="text-muted">{{ $session->notes }}</p>
        @endif

        <table class="table">
            <thead class="table-light">
                <tr>
                    <th>Exercise</th>
                    <th>Muscle Group</th>
                    <th>Reps</th>
                    <th>Weight (kg)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($session->workoutSets as $set)
                <tr>
                    <td>{{ $set->exercise->name }}</td>
                    <td>{{ $set->exercise->muscle_group }}</td>
                    <td>{{ $set->reps }}</td>
                    <td>{{ $set->weight_kg }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('sessions.index') }}" class="btn btn-outline-secondary">Back</a>
    </div>
</div>
@endsection