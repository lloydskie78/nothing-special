<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubDepartment extends Model
{
    protected $table = 'department_sub';
    protected $primaryKey = 'id';
    protected $fillable = [
      'idDepartment',
      'departmentSubName',
      'status'
    ];

    public function scopeDepartmentSubNameAscending($query){
        return $query->orderBy('departmentSubName','asc');
    }
}
