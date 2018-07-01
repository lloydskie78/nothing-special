<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'ctbrands';
    protected $primaryKey = 'idBrand';
    protected $fillable = ['idBrand','brandName','imageFile','status'];

    public function products(){
        return $this->hasMany('App\Products','idBrand','idBrand');
    }

    public function scopeBrandAscending($query)
    {
        return $query->orderBy('brandName','asc');
    }
}
