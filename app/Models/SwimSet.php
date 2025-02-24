<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SwimSet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'workout_id',
        'exercise_id',
        'set_distance',
        'set_repetition',
        'rest_time',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the workout that the swim set belongs to.
     */
    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }
   // public function workouts()
    //{
      //  return $this->belongsToMany(Workout::class, 'workout_swim_sets');
    //}
    /**
     * Get the exercise that the swim set uses.
     */
    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}