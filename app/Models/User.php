<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table="users";
    protected $guraded = [];
    
    public function dealer(){
        return $this->hasMany(Earning::class,'user_id','id');
    }
    
    public function document(){
        return $this->hasOne(Document_files::class,'user_id','id')->where('status','0');
    }
    
}
