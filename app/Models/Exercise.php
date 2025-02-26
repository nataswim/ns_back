<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    /**
     * 🇬🇧 The attributes that are mass assignable.
     *
     * 🇬🇧 @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'exercise_level',
        'exercise_category',
        'upload_id',
        'user_id',
    ];

    /**
     * 🇬🇧 The attributes that should be cast.
     *
     * 🇬🇧 @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * 🇬🇧 Get the user that created the exercise.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 🇬🇧 Get the upload associated with the exercise.
     */
    public function upload()
    {
        return $this->belongsTo(Upload::class);
    }

    /**
     * 🇬🇧 Get the swim sets for the exercise.
     */
    public function swimSets()
    {
        return $this->hasMany(SwimSet::class);
    }

    /**
     * 🇬🇧 The workouts that belong to the exercise.
     */
    public function workouts()
    {
        return $this->belongsToMany(Workout::class, 'workout_exercises');
    }
    public function mylistItems()
{
    return $this->morphMany(MylistItem::class, 'item');
}
}