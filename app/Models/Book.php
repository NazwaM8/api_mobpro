<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $table = 'book';
    protected $fillable = [
        'Authorization','title', 'author', 'publisher', 'year', 'image'
    ];

}
