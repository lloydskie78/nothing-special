<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    protected $table = 'ctjobcategories';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];

    public function scopeJobCatAscending($query)
    {
        return $query->orderBy('name','asc');
    }
}
