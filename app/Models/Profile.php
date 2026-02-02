<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'type',
        'title',
        'visi',  // Tambahkan ini agar bisa tersimpan
        'misi',  // Tambahkan ini agar bisa tersimpan
        'image',
        'content',
    ];
}