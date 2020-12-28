<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $table = 'ctcareers';
    protected $primaryKey = 'idJob';
    protected $attributes = [
        'branchId' => '0',
        'luzon' => 'NOT SET',
        'visayas' => 'NOT SET',
        'mindanao' => 'NOT SET',
    ];

    protected $fillable = [
        'jobTitle',
        'branchId',
        'luzon',
        'visayas',
        'mindanao',
        'catID',
        'desc',
        'status',
        'dbstat'
    ];

    public function jobcategory(){
        return $this->hasOne('App\JobCategory','id','catID');
    }
}

        // 'branchName',
