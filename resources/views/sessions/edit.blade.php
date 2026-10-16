@extends('layouts.app')
@section('title', 'Edit Session')
@section('content')
<div class="card shadow-sm">
    <div class="card-header">Edit Session</div>
    <div class="card-body">
        <form method="POST" action="{{ route('sessions.update', $session) }}">
            @csrf @method('PUT')
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Date</label>
                    <input type="date" name="date" class="form-control" value="{{ $session->date }}" required>
                </div>
                <div class="col-md-8">
                    <label class="form-label">Notes</label>
                    <input type="text" name="notes" class="form-control" value="{{ $session->notes }}">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('sessions.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection