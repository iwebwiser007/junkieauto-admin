<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Auction;
use App\Models\Auction_bids;

class BidsController extends Controller
{
    //

    public function bids_auction(){
        $data['auction'] = Auction::where('status','2')->with(['user','bids','models'])->latest()->get();
        return view('bids.bids_auction',$data);
    }

    public function all_bids_auction(Request $req){
        $data['date1'] = $req->date1;
        $data['date2'] = $req->date2;
        if($req != ''){
            $data['headname'] = $req->bids_type;
            if($req->bids_type == 'Active Bids'){
                if($req->date1 == ''){
                    $data['bids'] = Auction_bids::where('status','1')->with(['user','auctions'=>function($q){
                        return $q->with('user','models');
                    }])->latest()->get();    
                }
                else{
                    $data['bids'] = Auction_bids::where('status','1')->with(['user','auctions'=>function($q){
                    return $q->with('user','models');
                }])->whereBetween('created_at',[$req->date1,$req->date2])->latest()->get();
                }
                
            }

            else if($req->bids_type == 'Win Bids'){
                if($req->date1 == ''){
                        $data['bids'] = Auction_bids::where('status','2')->with(['user','auctions'=>function($q){
                        return $q->with('user','models');
                    }])->latest()->get();    
                }
                else{
                    $data['bids'] = Auction_bids::where('status','2')->with(['user','auctions'=>function($q){
                    return $q->with('user','models');
                }])->whereBetween('created_at',[$date1,$date2])->latest()->get();
                }
            }

            else if($req->bids_type == 'Rejected Bids'){
                if($req->date1 == ''){
                        $data['bids'] = Auction_bids::where('status','0')->with(['user','auctions'=>function($q){
                        return $q->with('user','models');
                    }])->latest()->get();    
                }
                else{
                    $data['bids'] = Auction_bids::where('status','0')->with(['user','auctions'=>function($q){
                        return $q->with('user','models');
                    }])->whereBetween('created_at',[$req->date1,$req->date2])->latest()->get();
                }
            }
            
            
            
            else if($req->bids_type == 'All Bids' || $req->bids_type == ''){
                $data['headname'] = 'All Bids';
                $data['bids'] = Auction_bids::with(['user','auctions'=>function($q){
                    return $q->with('user','models');
                }])->latest()->get();
            }

        }
        //$data['auction'] = Auction::whereNotIn('status',['0','1'])->with(['user','bids','models','winbids'])->latest()->get();
        
        return view('bids.all_bids_auction',$data);
    }

    public function bids_detail($id, Request $req){

        $data['all_bids'] = Auction_bids::where('id',$id)->with('user')->first();
        
        $auction_id = Auction_bids::where('id',$id)->first();
        
        $data['owner'] = Auction::where('id',$auction_id->auction_id)->with(['user','category_translation','models','makes','uses','statuses'])->first();
        
        return view('bids.bidsdetail',$data);
    }

    public function deals(Request $req){

        if($req != ''){
            $data['headname'] = $req->bid_type;
            if($req->bid_type == 'Bid'){
                $data['auction'] = Auction_bids::where('status','2')->where('type','bid')->with(['user','bidwin'])->get();
            }

            if($req->bid_type == 'Pre-Bid'){
                $data['auction'] = Auction_bids::where('status','2')->where('type','pre_bid')->with(['user','bidwin'])->get();
            }

            if($req->bid_type == 'Direct-Buy'){
                $data['auction'] = Auction_bids::where('status','2')->where('type','direct_buy')->with(['user','bidwin'])->get();
            }
            
            if($req->bid_type == 'All' || $req->bid_type == ''){
                $data['headname'] = '';
                $data['auction'] = Auction_bids::where('status','2')->with(['user','bidwin'])->latest()->get();
            }

        }
        //$data['auction'] = Auction_bids::where('status','2')->with(['user','bidwin'])->latest()->get();
        return view('deals.deals',$data);
    }

}
