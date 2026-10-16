@extends('layouts.app')
@section('title', 'Log Workout')
@section('content')
<div class="card shadow-sm">
    <div class="card-header">Log a Workout</div>
    <div class="card-body">
        <form method="POST" action="{{ route('sessions.store') }}" id="sessionForm">
            @csrf
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Date</label>
                    <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="col-md-8">
                    <label class="form-label">Notes</label>
                    <input type="text" name="notes" class="form-control" placeholder="Optional notes...">
                </div>
            </div>

            <h5>Sets</h5>
            <div id="sets-container">
                <div class="row g-2 mb-2 set-row">
                    <div class="col-md-5">
                        <select name="sets[0][exercise_id]" class="form-select" required>
                            <option value="">Select exercise</option>
                            @foreach($exercises as $exercise)
                            <option value="{{ $exercise->id }}">{{ $exercise->name }} ({{ $exercise->muscle_group }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="sets[0][reps]" class="form-control" placeholder="Reps" min="1" required>
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="sets[0][weight_kg]" class="form-control" placeholder="Weight (kg)" step="0.5" min="0" required>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-outline-danger w-100 remove-set">✕</button>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-outline-secondary mt-2" id="addSet">+ Add Set</button>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Save Session</button>
                <a href="{{ route('sessions.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
let setIndex = 1;
document.getElementById('addSet').addEventListener('click', function() {
    const container = document.getElementById('sets-container');
    const template = container.querySelector('.set-row').cloneNode(true);
    template.querySelectorAll('input, select').forEach(el => {
        el.name = el.name.replace(/\[\d+\]/, '[' + setIndex + ']');
        el.value = '';
    });
    container.appendChild(template);
    setIndex++;
});

document.getElementById('sets-container').addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-set')) {
        const rows = document.querySelectorAll('.set-row');
        if (rows.length > 1) e.target.closest('.set-row').remove();
    }
});
</script>
@endsection