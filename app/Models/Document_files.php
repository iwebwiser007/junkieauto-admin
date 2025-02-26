<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document_files extends Model
{
    use HasFactory;
    protected $table = 'document_files';
    protected $guarded = [];
    
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
