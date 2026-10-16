@extends('layouts.app')
@section('title', 'Plan Detail')
@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between">
        <span>{{ $plan->title }}</span>
        <a href="{{ route('plans.edit', $plan) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
    </div>
    <div class="card-body">
        <table class="table">
            <thead class="table-light">
                <tr>
                    <th>Exercise</th>
                    <th>Muscle Group</th>
                </tr>
            </thead>
            <tbody>
                @forelse($plan->exercises as $exercise)
                <tr>
                    <td>{{ $exercise->name }}</td>
                    <td>{{ $exercise->muscle_group }}</td>
                </tr>
                @empty
                <tr><td colspan="2" class="text-muted text-center">No exercises in this plan.</td></tr>
                @endforelse
            </tbody>
        </table>
        <a href="{{ route('plans.index') }}" class="btn btn-outline-secondary">Back</a>
    </div>
</div>
@endsection