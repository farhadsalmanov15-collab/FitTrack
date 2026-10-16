<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exercise extends Model {
    use SoftDeletes;

    protected $fillable = ['name', 'muscle_group'];

    public function workoutSets() {
        return $this->hasMany(WorkoutSet::class);
    }
}