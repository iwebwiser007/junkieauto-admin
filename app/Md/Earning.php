<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Earning extends Model
{
    protected $table='admin_commissions';
    protected $guarded=[];

    public function auction(){
        return $this->hasone('App\Models\Auction','id','auction_id');
    }

    public function users(){
        return $this->hasone('App\Models\User','id','user_id');
    }

    public function user(){
        return $this->hasone('App\Models\User','id','user_id');
    }
}
