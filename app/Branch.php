<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    //changes Aug 28, 2019 dev: Pit
    //$fillable addded tooltipx,tooltipy

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
        'status',
        'tooltipx',
        'tooltipy'
    ];

    public function scopeBranchAscending($query)
    {
        return $query->orderBy('branchName', 'asc');
    }
}
