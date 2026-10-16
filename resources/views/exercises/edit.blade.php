@extends('layouts.app')
@section('title', 'Edit Exercise')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header">Edit Exercise</div>
            <div class="card-body">
                <form method="POST" action="{{ route('exercises.update', $exercise) }}">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $exercise->name) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Muscle Group</label>
                        <input type="text" name="muscle_group" class="form-control" value="{{ old('muscle_group', $exercise->muscle_group) }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('exercises.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection