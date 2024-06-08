<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'file_path', 'user_id'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
