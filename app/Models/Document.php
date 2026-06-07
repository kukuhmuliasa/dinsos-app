<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
  protected $fillable = [
    'title',
    'category',
    'file',
    'published_at',
  ];

  protected $casts = [
    'published_at' => 'date',
  ];
}
