<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'user_id', 'goods_detail_id', 'num'
    ];

    public function goods_detail()
    {
        return $this->hasOne('App\Models\GoodsDetail', 'id', 'goods_detail_id');
    }

}
