<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Earning;

class EarningController extends Controller
{
    //
    public function earnings(){
        $winner = Earning::get('user_id');
        $data['earning'] = Earning::with('users')->latest()->get();
        
        
        return view('Earning.earnings',$data);
    }
}
