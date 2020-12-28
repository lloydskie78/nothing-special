<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Applicantlog extends Model
{
    //changes Aug 28, 2019 dev: Pit
    //$fillable addded tooltipx,tooltipy
    protected $table = 'ctapplicantlog';
    protected $primaryKey = 'logid';

/**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = 'date';
    protected $fillable = [
        'name',
        'careers',
        'email',
        'contact'
    ];

    public function setUpdatedAtAttribute($value){
        // to Disable updated_at
    }

}
