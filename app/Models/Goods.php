<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Goods extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'name', 'is_sale', 'sku_top_id', 'sku_type_ids', 'desc', 'description', 'content', 'banner', 'slider',
    ];

    public function details()
    {
        return $this->hasMany('App\Models\GoodsDetail', 'goods_id', 'id');
    }

    public function banner_src()
    {
        return $this->hasOne('App\Models\Image', 'id', 'banner');
    }

    public function min_price()
    {
        return $this->hasOne('App\Models\GoodsDetail', 'goods_id', 'id')
            ->orderBy('price', 'ASC')->where('is_sale', '=', 1)
            ->select(['id', 'goods_id', 'price']);//
    }

    public function max_price()
    {
        return $this->hasOne('App\Models\GoodsDetail', 'goods_id', 'id')
            ->orderBy('price', 'DESC')->where('is_sale', '=', 1)
            ->select(['id', 'goods_id', 'price']);//
    }

    public function min_original_price()
    {
        return $this->hasOne('App\Models\GoodsDetail', 'goods_id', 'id')
            ->orderBy('original', 'ASC')->where('is_sale', '=', 1)
            ->select(['id', 'goods_id', 'price']);//
    }

    public function max_original_price()
    {
        return $this->hasOne('App\Models\GoodsDetail', 'goods_id', 'id')
            ->orderBy('original', 'DESC')->where('is_sale', '=', 1)
            ->select(['id', 'goods_id', 'price']);//
    }

    public function slider_src_list()
    {
        $sliderSrc = Image::whereIn('id', explode(',', $this->slider))->get();
        $this->setRelation('slider_src', $sliderSrc);
        return $sliderSrc;
    }

    public function stock()
    {
        return $this->details->sum('stock');
    }

    public function sku_types()
    {
        $skuTypes = GoodsSku::with('childs')->whereIn('id', explode(',', $this->sku_type_ids))->get();
        $this->setRelation('sku_types', $skuTypes);
        return $skuTypes;
    }


}
