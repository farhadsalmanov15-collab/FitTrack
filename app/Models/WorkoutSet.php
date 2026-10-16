
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutSet extends Model {
    protected $fillable = ['session_id', 'exercise_id', 'reps', 'weight_kg'];

    public function session() {
        return $this->belongsTo(WorkoutSession::class, 'session_id');
    }

    public function exercise() {
        return $this->belongsTo(Exercise::class);
    }
}