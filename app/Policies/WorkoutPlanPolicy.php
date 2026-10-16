<?php
namespace App\Policies;

use App\Models\User;
use App\Models\WorkoutPlan;

class WorkoutPlanPolicy {
    public function view(User $user, WorkoutPlan $plan): bool {
        return $user->id === $plan->user_id || $user->isAdmin();
    }

    public function update(User $user, WorkoutPlan $plan): bool {
        return $user->id === $plan->user_id;
    }

    public function delete(User $user, WorkoutPlan $plan): bool {
        return $user->id === $plan->user_id;
    }
}