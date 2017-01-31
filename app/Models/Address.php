<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    //
    protected $table = 'addresses';

    use SoftDeletes;

    protected $fillable = ['user_id', 'used_at', 'phone', 'consignee', 'province', 'city', 'district', 'address', 'postcode'];

    protected static $orderColumns = ['user_id', 'phone', 'consignee', 'province', 'city', 'district', 'address', 'postcode'];

    public static function getOrderColumns()
    {
        return self::$orderColumns;
    }

}
