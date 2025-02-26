<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    /**
     * 🇬🇧 The attributes that are mass assignable.
     *
     * 🇬🇧 @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'page_category',
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
     * 🇬🇧 Get the user that created the page.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 🇬🇧 Get the upload associated with the page.
     */
    public function upload()
    {
        return $this->belongsTo(Upload::class);
    }
}