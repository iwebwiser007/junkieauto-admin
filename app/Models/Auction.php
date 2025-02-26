<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Auction extends Model
{
    
    protected $table = 'auctions';
    protected $guarded = [];

    public function user(){
        return $this->hasOne('App\Models\User','id','user_id');
    }

    public function media(){
        return $this->hasMany('App\Models\Auction_media','auction_id','id');
    }

    public function category_translation(){
        return $this->hasone('App\Models\Category_translation','caregory_id','make');
    }

    public function makes(){
        return $this->hasone('App\Models\Category_translation','caregory_id','make');
    }

    public function models(){
        return $this->hasone('App\Models\Category_translation','caregory_id','model');
    }

    public function damages(){
        return $this->hasone('App\Models\Filter_translation','id','damage_type');
    }

    public function sec_damages(){
        return $this->hasone('App\Models\Filter_translation','id','secondary_damage_type');
    }

    public function drivelines(){
        return $this->hasone('App\Models\Filter_translation','id','drive_line_type');
    }

    public function bodies(){
        return $this->hasone('App\Models\Filter_translation','id','body_type');
    }

    public function fuels(){
        return $this->hasone('App\Models\Filter_translation','id','fuel_type');
    }

    public function transmissions(){
        return $this->hasone('App\Models\Filter_translation','id','transmission');
    }

    public function colors(){
        return $this->hasone('App\Models\Filter_translation','id','color');
    }

    public function catalytics(){
        return $this->hasone('App\Models\Filter_translation','id','catalytic_convertor');
    }

    public function statuses(){
        return $this->hasone('App\Models\Filter_translation','id','status');
    }

    public function uses(){
        return $this->hasone('App\Models\Filter_translation','id','used_type');
    }
    

    public function bids(){
        return $this->hasMany('App\Models\Auction_bids','auction_id','id');
    }

    public function winbids(){
        return $this->hasone('App\Models\Auction_bids','auction_id','id')->where('status','2');
    }

    public function bid(){
        return $this->hasone('App\Models\Auction_bids','auction_id','id');
    }

    

}
