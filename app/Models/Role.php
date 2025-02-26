<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * 🇬🇧 The attributes that are mass assignable.
     *
     * 🇬🇧 @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * 🇬🇧 The attributes that should be cast.
     *
     * 🇬🇧 @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * 🇬🇧 Get the users for the role.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}