<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class shop extends Model
{
    //
    protected $fillable = [
        'status', 'discount', 'notice','send_cost','start_send','zhun','piao','bao','fengniao',
        'on_time','brand','shop_rating','shop_img','shop_name','shop_category_id'
    ];
    public function shopcategory(){
        return $this->belongsTo(ShopCategory::class,'shop_category_id','id');
        //return Student::find($this->student_id);

    }

}
