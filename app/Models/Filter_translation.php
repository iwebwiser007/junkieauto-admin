<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filter_translation extends Model
{
    protected $table = 'filter_translations';
    protected $guarded = [];

    public function list(){
        return $this->hasOne('App\Models\Filter_list','id','filter_id')->where('status','1');
    }

    public function label(){
        return $this->hasOne('App\Models\Filter_lable','id','filter_id')->whereNotIn('filter_id',[2,13]);
    }

    
}
