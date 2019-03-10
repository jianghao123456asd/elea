<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event_member extends Model
{
    //
    public function user(){
        return $this->belongsTo(User::class,'member_id','id');
        //return Student::find($this->student_id);

    }

}
