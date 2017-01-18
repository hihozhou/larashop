<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cache;

class GoodsSales extends Model
{

    private static $beganAtCacheKey = 'SOLD_BEGAN_AT';
    private static $endedAtCacheKey = 'SOLD_ENDED_AT';

    protected $fillable = [
        'goods_detail_id', 'is_sale', 'discount', 'stock', 'began_at', 'ended_at'
    ];

    use SoftDeletes;

    public function detail()
    {
        return $this->hasOne('App\Models\GoodsDetail', 'id', 'goods_detail_id');
    }

    /**
     * @return mixed
     */
    public static function getSoldBeganAt()
    {
        return Cache::get(self::$beganAtCacheKey, '0000/00/00 00:00');
    }

    public static function getSoldEndedAt()
    {
        return Cache::get(self::$endedAtCacheKey, '0000/00/00 00:00');
    }

    public static function cacheSoldBeganAt($beganAt)
    {
        Cache::forever(self::$beganAtCacheKey, $beganAt);
    }

    public static function cacheSoldEndedAt($endedAt)
    {
        Cache::forever(self::$endedAtCacheKey, $endedAt);
    }

}
