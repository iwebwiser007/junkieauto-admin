<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Earning;
use App\Models\Filter_translation;

class EarningController extends Controller
{
    //
    public function earnings(Request $req){
        
        $winner = Earning::get('user_id');
        $data['used_type'] = Filter_translation::where('filter_id','10')->get();
        $uses_type = $req->auc_type;
        $data['date1'] = $req->date1;
        $data['date2'] = $req->date2;
        $data['earn'] = Earning::sum('commission_amount');
        
        
        if($req != ''){
            $data['headname'] = $req->auc_type;
            if($req->date1 !=''){
                $data['headname'] = 'Auctionwise';
                $data['earning'] = Earning::with(['users','auction'=>function($q){
            
                    return $q->with('makes','models','uses');
                    }])->whereBetween('created_at', [$req->date1, $req->date2])->latest()->get();
            }
            else if($req->auc_type == 'All' || $req->auc_type == ''){
                
                $data['earning'] = Earning::with(['users','auction'=>function($q){
            
                    return $q->with('makes','models','uses');
                    }])->latest()->get();
            }
            else{
                
                $data['earning'] = Earning::with(['users','auction'=>function($q) use($uses_type){
                    $q->with(['makes','models','uses'=>function($k) use($uses_type){
                        return  $k->where('id',$uses_type);

                    }]);
                }])->latest()->get();

            }


        }
        // $data['earning'] = Earning::with(['users','auction'=>function($q){
            
        //     return $q->with('makes','models','uses');
        // }])->latest()->get();
        
        
        return view('Earning.earnings',$data);
    }
}
