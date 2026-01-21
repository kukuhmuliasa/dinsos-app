<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Tambahkan baris di bawah ini
    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'status',
    ];
}