<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
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
        'plan_category',
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
     * 🇬🇧 Get the user that created the plan.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 🇬🇧 The workouts that belong to the plan.
     */
    public function workouts()
    {
        return $this->belongsToMany(Workout::class, 'plan_workouts');
    }
    public function mylistItems()
{
    return $this->morphMany(MylistItem::class, 'item');
}
}
