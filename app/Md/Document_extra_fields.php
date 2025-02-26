<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document_extra_fields extends Model
{
    protected $table = 'document_extra_fields';
    protected $guarded = 'document_files';

    public function files(){
        return $this->hasOne('App\Models\Document_files','id','document_id')->where('status','1');
    }
}
