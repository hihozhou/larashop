<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Goods extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'name', 'is_sale', 'sku_top_id', 'desc', 'description', 'content', 'banner', 'silder',
    ];

    public function details()
    {

        return $this->hasMany('App\Models\GoodsDetail', 'goods_id', 'id');
    }


}
