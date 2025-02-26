<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction_bids extends Model
{
    protected $table = 'auction_bids';
    protected $guarded = [];

    public function user(){
        return $this->hasone('App\Models\User','id','user_id');
    }

    public function users(){
        return $this->hasMany('App\Models\User','id','user_id');
    }

    public function bidwin(){
        return $this->hasone('App\Models\Auction','id','auction_id');
    }

    public function auction(){
        return $this->hasMany('App\Models\Auction','id','auction_id');
    }
    

    
}
