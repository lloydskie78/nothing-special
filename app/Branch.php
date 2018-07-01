<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'ctbranches';
    protected $primaryKey = 'idBranch';
    protected $fillable = [
        'branchName',
        'branchCode',
        'islandGroup',
        'address',
        'telno',
        'faxno',
        'email',
        'storeHours',
        'imageFile',
        'latlng',
        'status'
    ];
}
