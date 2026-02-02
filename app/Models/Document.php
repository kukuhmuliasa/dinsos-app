<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
<<<<<<< Updated upstream
    protected $fillable = ['title', 'file_path', 'category'];
=======
  protected $fillable = [
    'title',
    'category',
    'file',];
>>>>>>> Stashed changes
}
