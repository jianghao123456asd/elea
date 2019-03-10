<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class carts extends Model
{
    //
    public function menu(){
        return $this->belongsTo(Menu::class,'goods_id','id');
        //return Student::find($this->student_id);

    }
}
