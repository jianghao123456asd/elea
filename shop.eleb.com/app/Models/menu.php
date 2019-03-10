<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    //

    public function clas(){
        return $this->belongsTo(\App\Models\menu_categorie::class,'category_id','id');
        //return Student::find($this->student_id);

    }
    protected $fillable = [
        'goods_name','rating','shop_id','category_id','goods_price','description','month_sales','rating_count',
        'tips','satisfy_count','satisfy_rate','goods_img','status'
    ];

}
