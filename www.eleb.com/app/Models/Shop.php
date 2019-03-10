<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    //
    protected $fillable = [
        'status', 'discount', 'notice','send_cost','start_send','zhun','piao','bao','fengniao',
        'on_time','brand','shop_rating','shop_img','shop_name','shop_category_id'
    ];
}
