<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAction extends Model
{
    protected $fillable = ['order_id', 'desc', 'create_at'];


    public function setUpdatedAt($value)
    {
        // Do nothing.
    }

}
