<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodsDetailSku extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'goods_detail_id', 'sku_id',
    ];

    public function sku()
    {
        return $this->hasOne('App\Models\GoodsSku', 'id', 'sku_id');
    }

}
