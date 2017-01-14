<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodsDetail extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'goods_id', 'is_sale', 'stock', 'sales', 'image_id', 'original', 'price'
    ];

    public function skus()
    {

        return $this->hasMany('App\Models\GoodsDetailSku', 'goods_detail_id', 'id');
    }

}
