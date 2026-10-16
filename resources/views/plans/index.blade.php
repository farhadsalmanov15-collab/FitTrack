@extends('layouts.app')
@section('title', 'My Plans')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>My Workout Plans</h2>
    <a href="{{ route('plans.create') }}" class="btn btn-primary">+ New Plan</a>
</div>

<div class="row g-3">
    @forelse($plans as $plan)
    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h5>{{ $plan->title }}</h5>
                <p class="text-muted">{{ $plan->exercises->count() }} exercises</p>
            </div>
            <div class="card-footer d-flex gap-2">
                <a href="{{ route('plans.show', $plan) }}" class="btn btn-sm btn-outline-primary">View</a>
                <a href="{{ route('plans.edit', $plan) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                <form method="POST" action="{{ route('plans.destroy', $plan) }}">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')">Delete</button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <p class="text-muted">No plans yet.</p>
    @endforelse
</div>
@endsection