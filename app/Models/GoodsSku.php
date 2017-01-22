<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodsSku extends Model
{
    use SoftDeletes;

    //

    protected $fillable = array('name', 'pid');

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function parent()
    {

        return $this->belongsTo('App\Models\GoodsSku', 'pid', 'id');
    }

    public function childs()
    {

        return $this->hasMany('App\Models\GoodsSku', 'pid', 'id');
    }

    public static function tree()
    {
        return GoodsSku::with('childs.childs')->get()->reject(function ($item) {
            return $item['pid'] > 0;
        });
    }
}
