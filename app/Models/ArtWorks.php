<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArtWorks extends Model
{
    protected $table = 'art_works';

    protected $fillable = [
        'Authorization',
        'title',
        'type',
        'date',
        'image',
    ];
}
