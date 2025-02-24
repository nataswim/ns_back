<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MylistItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'mylist_id',
        'item_id',
        'item_type',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];

    /**
     * Get the mylist that the item belongs to.
     */
    public function mylist()
    {
        return $this->belongsTo(Mylist::class);
    }

    // Les relations polymorphiques seront définies ici (voir explication plus bas)
    /**
     * Get the item (exercise, workout, or plan).
     */
    public function item()
    {
        return $this->morphTo();
    }
}
