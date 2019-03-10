<?php


namespace App\Models;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Admin extends Authenticatable
{
    //
    use HasRoles;
    protected $guard_name='web';
    protected $fillable = [
      'name','email','password'
    ];
}
