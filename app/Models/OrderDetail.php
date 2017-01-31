<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public $timestamps = false;

    protected $fillable = ['order_id', 'goods_detail_id', 'price', 'num', 'total_price'];

    public function goods_detail()
    {
        return $this->hasOne('App\Models\GoodsDetail', 'id', 'goods_detail_id');
    }

}
