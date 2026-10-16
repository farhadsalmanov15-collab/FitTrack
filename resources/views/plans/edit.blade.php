@extends('layouts.app')
@section('title', 'Edit Plan')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card shadow-sm">
            <div class="card-header">Edit Workout Plan</div>
            <div class="card-body">
                <form method="POST" action="{{ route('plans.update', $plan) }}">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $plan->title) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Exercises</label>
                        <div class="border rounded p-3" style="max-height:300px;overflow-y:auto">
                            @foreach($exercises as $exercise)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="exercises[]" value="{{ $exercise->id }}" id="ex{{ $exercise->id }}"
                                    {{ $plan->exercises->contains($exercise->id) ? 'checked' : '' }}>
                                <label class="form-check-label" for="ex{{ $exercise->id }}">
                                    {{ $exercise->name }} <span class="text-muted">({{ $exercise->muscle_group }})</span>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Plan</button>
                    <a href="{{ route('plans.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection