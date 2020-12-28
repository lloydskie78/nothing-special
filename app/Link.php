<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
	protected $table = 'ctlinks';
    protected $primaryKey = 'id';
    protected $fillable = ['image','name','desc','status'];
}