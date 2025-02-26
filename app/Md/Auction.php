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
        return $this->hasone('App\Models\User','id','user_id');
    }

    public function media(){
        return $this->hasMany('App\Models\Auction_media','auction_id','id');
    }

    public function category_translation(){
        return $this->hasone('App\Models\Category_translation','caregory_id','make')->where('language',user()->language);
    }

    public function makes(){
        return $this->hasone('App\Models\Category_translation','caregory_id','make')->where('language',user()->language);
    }

    public function models(){
        return $this->hasone('App\Models\Category_translation','caregory_id','model')->where('language',user()->language);
    }

    public function damages(){
        return $this->hasone('App\Models\Filter_translation','id','damage_type')->where('language',user()->language);
    }

    public function sec_damages(){
        return $this->hasone('App\Models\Filter_translation','id','secondary_damage_type')->where('language',user()->language);
    }

    public function drivelines(){
        return $this->hasone('App\Models\Filter_translation','id','drive_line_type')->where('language',user()->language);
    }

    public function bodies(){
        return $this->hasone('App\Models\Filter_translation','id','body_type')->where('language',user()->language);
    }

    public function fuels(){
        return $this->hasone('App\Models\Filter_translation','id','fuel_type')->where('language',user()->language);
    }

    public function transmissions(){
        return $this->hasone('App\Models\Filter_translation','id','transmission')->where('language',user()->language);
    }

    public function colors(){
        return $this->hasone('App\Models\Filter_translation','id','color')->where('language',user()->language);
    }

    public function catalytics(){
        return $this->hasone('App\Models\Filter_translation','id','catalytic_convertor')->where('language',user()->language);
    }

    public function statuses(){
        return $this->hasone('App\Models\Filter_translation','id','status')->where('language',user()->language);
    }

    public function uses(){
        return $this->hasone('App\Models\Filter_translation','id','used_type')->where('language',user()->language);
    }
    

    public function bids(){
        return $this->hasMany('App\Models\Auction_bids','auction_id','id');
    }

    public function winbids(){
        return $this->hasone('App\Models\Auction_bids','auction_id','id')->where('status','2');
    }

    

}
