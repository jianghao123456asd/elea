<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event_prize extends Model
{
    //
    protected $fillable = [
        'name','email','member_id'
    ];
    public function et(){
        return $this->belongsTo(Event::class,'events_id','id');
        //return Student::find($this->student_id);

    }
    public function user(){
        return $this->belongsTo(User::class,'member_id','id');
        //return Student::find($this->student_id);

    }
}
