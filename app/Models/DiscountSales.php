<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiscountSales extends Model
{
    use SoftDeletes;

    protected $fillable = ['is_sale', 'began_at', 'ended_at'];

    public function details()
    {
        return $this->hasMany('App\Models\DiscountSaleDetails', 'id', 'discount_sale_id');
    }

    public static function soldAtExit($beganAt, $endedAt)
    {
        try {
            $sales = self::where(function ($query) use ($beganAt, $endedAt) {
                $query->where('began_at', '>=', $beganAt);
                $query->where('began_at', '<=', $endedAt);
            })->orWhere(function ($query) use ($beganAt, $endedAt) {
                $query->where('began_at', '<=', $beganAt);
                $query->where('ended_at', '>=', $endedAt);
            })->firstOrFail();
        } catch (\Exception $e) {
            throw $e;
        }
        return $sales;
    }
}
