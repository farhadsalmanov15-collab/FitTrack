
@extends('layouts.app')
@section('title', 'Exercises')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Exercise Library</h2>
    @if(auth()->check() && auth()->user()->isAdmin())
    <a href="{{ route('exercises.create') }}" class="btn btn-primary">+ Add Exercise</a>
    @endif
</div>

<form method="GET" class="row g-2 mb-4">
    <div class="col-md-5">
        <input type="text" name="search" class="form-control" placeholder="Search exercises..." value="{{ request('search') }}">
    </div>
    <div class="col-md-4">
        <select name="muscle_group" class="form-select">
            <option value="">All muscle groups</option>
            @foreach($muscleGroups as $group)
            <option value="{{ $group }}" {{ request('muscle_group') == $group ? 'selected' : '' }}>{{ $group }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <button type="submit" class="btn btn-outline-primary w-100">Filter</button>
    </div>
</form>

<div class="row g-3">
    @forelse($exercises as $exercise)
    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">{{ $exercise->name }}</h5>
                <span class="badge bg-primary">{{ $exercise->muscle_group }}</span>
            </div>
            @if(auth()->check() && auth()->user()->isAdmin())
            <div class="card-footer d-flex gap-2">
                <a href="{{ route('exercises.edit', $exercise) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                <form method="POST" action="{{ route('exercises.destroy', $exercise) }}">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')">Delete</button>
                </form>
            </div>
            @endif
        </div>
    </div>
    @empty
    <p class="text-muted">No exercises found.</p>
    @endforelse
</div>

<div class="mt-4">{{ $exercises->links() }}</div>
@endsection