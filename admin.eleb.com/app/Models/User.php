<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $fillable = [
        'name', 'password', 'status','email','shop_id',
    ];
    public function shop(){
        return $this->belongsTo(Shop::class,'shop_id','id');
        //return Student::find($this->student_id);

    }
}
