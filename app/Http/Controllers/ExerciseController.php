<?php
namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExerciseController extends Controller {

    public function index(Request $request) {
        $query = Exercise::query();
        if ($request->filled('muscle_group')) {
            $query->where('muscle_group', $request->muscle_group);
        }
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $exercises = $query->paginate(12);
        $muscleGroups = Exercise::select('muscle_group')->distinct()->pluck('muscle_group');
        return view('exercises.index', compact('exercises', 'muscleGroups'));
    }

    public function create() {
        return view('exercises.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'muscle_group' => 'required|string|max:255'
        ]);
        $exercise = Exercise::create($request->only('name', 'muscle_group'));
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'created',
            'model' => 'Exercise:' . $exercise->id,
            'timestamp' => now()
        ]);
        return redirect()->route('exercises.index')->with('success', 'Exercise created.');
    }

    public function edit(Exercise $exercise) {
        return view('exercises.edit', compact('exercise'));
    }

    public function update(Request $request, Exercise $exercise) {
        $request->validate([
            'name' => 'required|string|max:255',
            'muscle_group' => 'required|string|max:255'
        ]);
        $exercise->update($request->only('name', 'muscle_group'));
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'updated',
            'model' => 'Exercise:' . $exercise->id,
            'timestamp' => now()
        ]);
        return redirect()->route('exercises.index')->with('success', 'Exercise updated.');
    }

    public function destroy(Exercise $exercise) {
        $exercise->delete();
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'deleted',
            'model' => 'Exercise:' . $exercise->id,
            'timestamp' => now()
        ]);
        return redirect()->route('exercises.index')->with('success', 'Exercise deleted.');
    }

    public function restore($id) {
        $exercise = Exercise::withTrashed()->findOrFail($id);
        $exercise->restore();
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'restored',
            'model' => 'Exercise:' . $exercise->id,
            'timestamp' => now()
        ]);
        return redirect()->route('exercises.index')->with('success', 'Exercise restored.');
    }
}