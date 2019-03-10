<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Navs extends Model
{
    //
    protected $fillable = [
        'name','pid','url','permission_id','Permission'
    ];
    public function per(){
        return $this->hasMany(Permission::class,'id','permission_id');
        //return Student::find($this->student_id);

    }
    public function permission(){
        return $this->belongsTo(Permission::class,'permission_id','id');
    }
}
