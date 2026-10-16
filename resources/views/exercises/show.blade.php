@extends('layouts.app')
@section('title', 'Exercise')
@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h2>{{ $exercise->name }}</h2>
        <span class="badge bg-primary">{{ $exercise->muscle_group }}</span>
        <div class="mt-3">
            <a href="{{ route('exercises.index') }}" class="btn btn-outline-secondary">Back</a>
        </div>
    </div>
</div>
@endsection