<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'workout_category',
        'user_id',
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
     * Get the user that created the workout.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The exercises that belong to the workout.
     */
    public function exercises()
    {
        return $this->belongsToMany(Exercise::class, 'workout_exercises');
    }

    /**
     * The plans that the workout is included in.
     */
    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'plan_workouts');
    }

    /**
     * Get the swim sets for the workout.
     */
    public function swimSets()
    {
        return $this->belongsToMany(SwimSet::class, 'workout_swim_sets');
    }
    //public function swimSets()
//{
  //  return $this->belongsToMany(SwimSet::class, 'workout_swim_sets');
//}
public function mylistItems()
{
    return $this->morphMany(MylistItem::class, 'item');
}
    
}
