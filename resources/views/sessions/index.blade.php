@extends('layouts.app')
@section('title', 'My Sessions')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>My Sessions</h2>
    <a href="{{ route('sessions.create') }}" class="btn btn-primary">+ Log Workout</a>
</div>

<div class="card shadow-sm">
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
                @forelse($sessions as $session)
                <tr>
                    <td>{{ $session->date }}</td>
                    <td>{{ $session->workoutSets->pluck('exercise.name')->unique()->join(', ') }}</td>
                    <td>{{ $session->workoutSets->count() }}</td>
                    <td>{{ $session->notes ?? '-' }}</td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('sessions.show', $session) }}" class="btn btn-sm btn-outline-primary">View</a>
                        <a href="{{ route('sessions.edit', $session) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                        <form method="POST" action="{{ route('sessions.destroy', $session) }}">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted">No sessions yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-4">{{ $sessions->links() }}</div>
@endsection