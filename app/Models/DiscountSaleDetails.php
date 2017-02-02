<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountSaleDetails extends Model
{
    protected $fillable = ['discount_sale_id', 'goods_detail_id', 'discount', 'is_sale', 'stock', 'sort'];

    public function goods_detail()
    {
        return $this->hasOne('App\Models\GoodsDetail', 'id', 'goods_detail_id');
    }
}
