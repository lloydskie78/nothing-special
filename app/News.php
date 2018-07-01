<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'ctnews';
    protected $fillable = [
        'title',
        'content',
        'status',
        'imageFile',
        'imagePoster',
    ];

    protected $primaryKey = 'idNews';

}
