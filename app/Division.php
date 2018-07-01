<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $table = 'ctdivision';
    protected $primaryKey = 'idDivision';
    protected $fillable = [
        'EBSid',
        'Division',
        'division_status'
    ];

    public function scopeDivisionAscending($query){
        return $query->orderBy('Division','asc');
    }

    public function subcategories() {
        return $this->hasMany('App\Department','idDivision','idDivision')->orderBy('Department','asc');
    }

}
