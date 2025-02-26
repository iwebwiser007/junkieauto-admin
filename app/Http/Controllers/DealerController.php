<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auction_bids;
use App\Models\Auction;
use App\Models\User;
use App\Models\Earning;
use App\Models\Document_extra_fields;
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

    public function dealer_detail($id, Request $req){
        $data['dealer'] = User::where('id',$id)->first();
        $data['media'] = Document_extra_fields::where('user_id',$id)->with('files')->get();
        
        $data['deals'] = Earning::where('user_id',$id)->with(['user','auction'=>function($q){
            return $q->with('user','models');
        }])->latest()->get();
        // $data['all_bids'] = Auction_bids::where('user_id',$id)->with(['user','auction'=>function($q){
        //     return $q->with('user');
        // }])->latest()->get();

        if($req != ''){
            $data['headname'] = $req->bids_type;
            if($req->bids_type == 'Active Bids'){
                
                $data['all_bids'] = Auction_bids::where('status','1')->where('user_id',$id)->with(['user','auction'=>function($q){
                    return $q->with('user','makes','models');
                }])->latest()->get();
            }

            if($req->bids_type == 'Lost Bids'){
                $data['all_bids'] = Auction_bids::where('status','0')->where('user_id',$id)->with(['user','auction'=>function($q){
                    return $q->with('user','makes','models');
                }])->latest()->get();
            }

            if($req->bids_type == 'Win Bids'){
                $data['all_bids'] = Auction_bids::where('status','2')->where('user_id',$id)->with(['user','auction'=>function($q){
                    return $q->with('user','makes','models');
                }])->latest()->get();
            }
            
            if($req->bids_type == 'All Bids' || $req->bids_type == ''){
                $data['headname'] = 'All Bids';
                $data['all_bids'] = Auction_bids::where('user_id',$id)->with(['user','auction'=>function($q){
                    return $q->with('user','makes','models');
                }])->latest()->get();
            }

        }


        return view('dealer.dealer_detail',$data);
    }
}
