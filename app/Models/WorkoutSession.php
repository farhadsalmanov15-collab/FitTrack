<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutSession extends Model {
    protected $fillable = ['user_id', 'date', 'notes'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function workoutSets() {
        return $this->hasMany(WorkoutSet::class, 'session_id');
    }
}