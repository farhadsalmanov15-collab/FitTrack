<?php
namespace App\Http\Controllers;

use App\Models\WorkoutSession;
use App\Models\Exercise;
use App\Models\WorkoutSet;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkoutSessionController extends Controller {

    public function index() {
        $sessions = Auth::user()->workoutSessions()
            ->with('workoutSets.exercise')
            ->orderBy('date', 'desc')
            ->paginate(10);
        return view('sessions.index', compact('sessions'));
    }

    public function create() {
        $exercises = Exercise::all();
        return view('sessions.create', compact('exercises'));
    }

    public function store(Request $request) {
        $request->validate([
            'date' => 'required|date',
            'notes' => 'nullable|string',
            'sets' => 'required|array|min:1',
            'sets.*.exercise_id' => 'required|exists:exercises,id',
            'sets.*.reps' => 'required|integer|min:1',
            'sets.*.weight_kg' => 'required|numeric|min:0'
        ]);

        $session = WorkoutSession::create([
            'user_id' => Auth::id(),
            'date' => $request->date,
            'notes' => $request->notes
        ]);

        foreach ($request->sets as $set) {
            WorkoutSet::create([
                'session_id' => $session->id,
                'exercise_id' => $set['exercise_id'],
                'reps' => $set['reps'],
                'weight_kg' => $set['weight_kg']
            ]);
        }

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'created',
            'model' => 'WorkoutSession:' . $session->id,
            'timestamp' => now()
        ]);

        return redirect()->route('sessions.index')->with('success', 'Session logged.');
    }

    public function show(WorkoutSession $session) {
        if (Auth::id() !== $session->user_id && !Auth::user()->isAdmin()) {
            abort(403);
        }
        $session->load('workoutSets.exercise');
        return view('sessions.show', compact('session'));
    }

    public function edit(WorkoutSession $session) {
        if (Auth::id() !== $session->user_id) {
            abort(403);
        }
        $exercises = Exercise::all();
        return view('sessions.edit', compact('session', 'exercises'));
    }

    public function update(Request $request, WorkoutSession $session) {
        if (Auth::id() !== $session->user_id) {
            abort(403);
        }
        $request->validate([
            'date' => 'required|date',
            'notes' => 'nullable|string'
        ]);
        $session->update($request->only('date', 'notes'));

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'updated',
            'model' => 'WorkoutSession:' . $session->id,
            'timestamp' => now()
        ]);

        return redirect()->route('sessions.index')->with('success', 'Session updated.');
    }

    public function destroy(WorkoutSession $session) {
        if (Auth::id() !== $session->user_id && !Auth::user()->isAdmin()) {
            abort(403);
        }
        $session->delete();

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'deleted',
            'model' => 'WorkoutSession:' . $session->id,
            'timestamp' => now()
        ]);

        return redirect()->route('sessions.index')->with('success', 'Session deleted.');
    }
}