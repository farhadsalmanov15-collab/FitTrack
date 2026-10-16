<?php
namespace App\Http\Controllers;

use App\Models\WorkoutPlan;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkoutPlanController extends Controller {

    public function index() {
        $plans = Auth::user()->workoutPlans()->with('exercises')->get();
        return view('plans.index', compact('plans'));
    }

    public function create() {
        $exercises = Exercise::all();
        return view('plans.create', compact('exercises'));
    }

    public function store(Request $request) {
        $request->validate(['title' => 'required|string|max:255']);
        $plan = WorkoutPlan::create([
            'user_id' => Auth::id(),
            'title' => $request->title
        ]);
        if ($request->exercises) {
            $plan->exercises()->sync($request->exercises);
        }
        return redirect()->route('plans.index')->with('success', 'Plan created.');
    }

   / public function show(WorkoutPlan $plan) {
        if (Auth::id() !== $plan->user_id && !Auth::user()->isAdmin()) {
            abort(403);
        }
        $plan->load('exercises');
        return view('plans.show', compact('plan'));
    }

    public function edit(WorkoutPlan $plan) {
        if (Auth::id() !== $plan->user_id && !Auth::user()->isAdmin()) {
            abort(403);
        }
        $exercises = Exercise::all();
        return view('plans.edit', compact('plan', 'exercises'));
    }

    public function update(Request $request, WorkoutPlan $plan) {
        if (Auth::id() !== $plan->user_id && !Auth::user()->isAdmin()) {
            abort(403);
        }
        $request->validate(['title' => 'required|string|max:255']);
        $plan->update(['title' => $request->title]);
        $plan->exercises()->sync($request->exercises ?? []);
        return redirect()->route('plans.index')->with('success', 'Plan updated.');
    }

    public function destroy(WorkoutPlan $plan) {
        if (Auth::id() !== $plan->user_id && !Auth::user()->isAdmin()) {
            abort(403);
        }
        $plan->delete();
        return redirect()->route('plans.index')->with('success', 'Plan deleted.');
    }
}