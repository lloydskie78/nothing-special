<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'ctdepartment';
    protected $primaryKey = 'idDepartment';
    protected $fillable = [
        'EBSid',
        'Department',
        'idDivision',
        'department_status'
    ];

    public function division(){
        return $this->hasOne('App\Division','idDivision','idDivision');
    }

    public function subDepartment(){
        return $this->hasMany('App\SubDepartment','idDepartment','idDepartment');
    }

    public function scopeDepartmentAscending($query)
    {
        return $query->orderBy('Department','asc');
    }
}
