<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commission;

class CommissionController extends Controller
{
    //
    public function commission(){
        
        $data['commission'] = Commission::latest()->get();
        return view('commission.commission',$data);
        
    }

    public function add_commission(Request $req){
        $req->validate([
            'commission'=> 'required',
            ]);
        
        Commission::where('status','1')->update([
            'status'=>'0'
        ]);

        Commission::create([
            'commission' => $req->commission,
            'status'=> '1'
        ]);
        return redirect('commission');
    }
}
