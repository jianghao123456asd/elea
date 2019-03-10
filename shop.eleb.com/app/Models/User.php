<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    //
    //
    protected $fillable = [
        'name','password','email','shop_id','status','remember_token'
    ];
    public function shop(){
        return $this->belongsTo(\App\Shop::class,'shop_id','id');
        //return Student::find($this->student_id);

    }
}
