<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auction_bids;
use App\Models\User;
use App\Models\Earning;
use Illuminate\Support\Facades\DB;


class DealerController extends Controller
{
    //
    public function all_dealer(Request $req){
        if($req != ''){
            $data['headname'] = $req->dealer_type;
            if($req->dealer_type == 'Top Dealer'){
                $data['dealer'] = Earning::with(['user'])->select('user_id',DB::raw('sum(bid_amount) as a'))->groupBy('user_id')->get();
            }

            if($req->dealer_type == 'All Dealer' || $req->dealer_type == ''){
                $data['headname'] = 'All Dealer';
                
                $data['dealer'] = Earning::with(['user'])->get();
            }

        }
        //$data['dealer'] = Auction_bids::where('status','2')->with('user')->latest()->get();
        return view('dealer.all_dealer',$data);
    }

    public function dealer_detail($id){
        $data['dealer'] = User::where('id',$id)->first();
        //$data['deals'] = Auction_bids::where('status','2')->with(['user','auction'])->latest()->get();
        $data['deals'] = Earning::where('user_id',$id)->with(['user','auction'=>function($q){
            return $q->with('user','models');
        }])->latest()->get();
        
        return view('dealer.dealer_detail',$data);
    }
}
