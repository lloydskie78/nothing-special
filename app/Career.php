<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $table = 'ctcareers';
    protected $primaryKey = 'idJob';
    protected $fillable = [
        'jobTitle',
        'catID',
        'desc',
        'status',
        'dbstat'
    ];

    public function jobcategory(){
        return $this->hasOne('App\JobCategory','id','catID');
    }
}
