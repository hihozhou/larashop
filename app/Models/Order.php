<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = ['sn', 'user_id', 'phone', 'consignee', 'province', 'city', 'district', 'address', 'postcode', 'express', 'express_no', 'message', 'total_price', 'discount', 'paid_price', 'paid_way', 'paid_at'];

    public function details()
    {
        return $this->hasMany('App\Models\OrderDetail', 'order_id', 'id');
    }

    public static function generateSn()
    {
        return 'le' . time() . getRandomStr(5, '0123456789');
    }

    public function order_actions()
    {
        return $this->hasMany('App\Models\OrderAction', 'order_id', 'id');
    }
}
