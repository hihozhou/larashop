<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodsSku extends Model
{
    use SoftDeletes;
    //

    public function parent()
    {

        return $this->belongsTo('App\Models\GoodsSku', 'pid', 'id');
    }

    public function childs()
    {

        return $this->hasMany('App\Models\GoodsSku', 'pid', 'id');
    }
}
