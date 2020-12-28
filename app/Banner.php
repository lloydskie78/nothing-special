<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    //changes Aug 28, 2019 dev: Pit
    //$fillable addded tooltipx,tooltipy

    protected $table = 'ctbanner';
    protected $primaryKey = 'bannerid';
    protected $fillable = [
        'pagename',
        'bannerimage',
        'pagevideo'
    ];
}
