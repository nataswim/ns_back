<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'role_id',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function plans()
    {
        return $this->hasMany(Plan::class);
    }

    public function workouts()
    {
        return $this->hasMany(Workout::class);
    }

    public function mylists()
    {
        return $this->hasMany(Mylist::class);
    }
}