<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'filename',
        'path',
        'type',
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
     * Get the user that uploaded the file.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //  relations (exercises, pages)

    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }
    // Correction : Postman :: getUserUploads utilise la relation uploads() de User
    public function getUserUploads(User $user)
    {
        $uploads = $user->uploads;
        return response()->json($uploads, 200);
    }
}
