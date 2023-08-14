<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ResetPassword extends Model
{
    
    protected $table = 'reset_passwords';
    protected $guarded  = ['id'];
    protected $fillable = ['user_id','token','flag','created_at','updated_at'];
   
}
