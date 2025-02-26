<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mylist extends Model
{
    use HasFactory;

    /**
     * 🇬🇧 The attributes that are mass assignable.
     *
     * 🇬🇧 @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
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
     * 🇬🇧 Get the user that owns the mylist.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 🇬🇧 Get the items in the mylist.
     */
    public function mylistItems()
    {
        return $this->hasMany(MylistItem::class); // Relation avec MylistItem
    }
}