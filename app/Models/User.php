<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role', 'avatar'];
    protected $hidden = ['password', 'remember_token'];

    public function isAdmin(): bool {
        return $this->role === 'admin';
    }

    public function workoutSessions() {
        return $this->hasMany(WorkoutSession::class);
    }

    public function workoutPlans() {
        return $this->hasMany(WorkoutPlan::class);
    }

    public function auditLogs() {
        return $this->hasMany(AuditLog::class);
    }
}