<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use Searchable;
    use SoftDeletes;

    protected $table = 'ctproducts';
    protected $primaryKey = 'idProduct';
    protected $fillable = ['idBrand', 'idParent', 'idSub', 'prodName', 'prodCode', 'details', 'price', 'imageFile', 'feaImageFile', 'availability', 'isfeatured', 'barcode', 'showProduct'];

    public function brand()
    {
        //        return $this->hasOne('App\Brand','idBrand','idBrand');
        return $this->belongsTo('App\Brand', 'idBrand', 'idBrand');
    }

    public function toSearchableArray()
    {
        $array = $this->only('prodName', 'prodCode');

        return $array;
    }

    public function searchableAs()
    {
        return 'fulltext_index';
    }

    public function getDetailsAttribute($value)
    {
        return str_replace("'", "&#39", $value);
    }


}
