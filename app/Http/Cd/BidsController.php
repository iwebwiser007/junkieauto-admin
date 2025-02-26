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
        
        if($req != ''){
            $data['headname'] = $req->bids_type;
            if($req->bids_type == 'Active Bids'){
                
                $data['auction'] = Auction::where('status','2')->with(['user','bids','models','winbids'])->latest()->get();
            }

            if($req->bids_type == 'Sold Bids'){
                $data['auction'] = Auction::where('status','3')->with(['user','bids','models','winbids'])->latest()->get();
            }

            if($req->bids_type == 'Closed Bids'){
                $data['auction'] = Auction::where('status','4')->with(['user','bids','models','winbids'])->latest()->get();
            }

            if($req->bids_type == 'Rejected Bids'){
                $data['auction'] = Auction::where('status','0')->with(['user','bids','models','winbids'])->latest()->get();
            }
            
            if($req->bids_type == 'All Bids' || $req->bids_type == ''){
                $data['headname'] = 'All Bids';
                $data['auction'] = Auction::whereNotIn('status',['0','1'])->with(['user','bids','models','winbids'])->latest()->get();
            }

        }
        //$data['auction'] = Auction::whereNotIn('status',['0','1'])->with(['user','bids','models','winbids'])->latest()->get();
        
        return view('bids.all_bids_auction',$data);
    }

    public function bids_detail($id, Request $req){

        if($req != ''){
            $data['headname'] = $req->bids_type;
            if($req->bids_type == 'Bids'){
                
                $data['all_bids'] = Auction_bids::where('auction_id',$id)->where('type','bid')->with('user')->get();
            }

            if($req->bids_type == 'Pre-Bids'){
                $data['all_bids'] = Auction_bids::where('auction_id',$id)->where('type','pre_bid')->with('user')->get();
            }

            if($req->bids_type == 'Direct Buy'){
                $data['all_bids'] = Auction_bids::where('auction_id',$id)->where('type','direct_buy')->with('user')->get();
            }

            if($req->bids_type == 'Rejected Bids'){
                $data['all_bids'] = Auction::where('status','0')->with(['user','bids','models','winbids'])->latest()->get();
            }
            
            if($req->bids_type == 'All Bids' || $req->bids_type == ''){
                $data['headname'] = 'All Bids';
                $data['all_bids'] = Auction_bids::where('auction_id',$id)->with('user')->get();
            }

        }
        $data['owner'] = Auction::where('id',$id)->with(['user','category_translation','models','makes','uses','statuses'])->first();
        //$data['owner'] = Auction::join('category_translations','auctions.make','category_translations.caregory_id')->where('auctions.id',$id)->where('category_translations.language',user()->language)->first();
        // $data['all_bids'] = Auction_bids::where('auction_id',$id)->with('user')->get();
        // $data['bids'] = Auction_bids::where('auction_id',$id)->where('type','bid')->with('user')->get();
        // $data['prebids'] = Auction_bids::where('auction_id',$id)->where('type','pre_bid')->with('user')->get();
        // $data['directbids'] = Auction_bids::where('auction_id',$id)->where('type','direct_buy')->with('user')->get();
        $data['winner'] = Auction_bids::where('auction_id',$id)->where('status','2')->with('user')->first();
        return view('bids.bidsdetail',$data);
    }

    public function deals(Request $req){

        if($req != ''){
            $data['headname'] = $req->bid_type;
            if($req->bid_type == 'Bid'){
                $data['auction'] = Auction_bids::where('type','bid')->with(['user','bidwin'])->get();
            }

            if($req->bid_type == 'Pre-Bid'){
                $data['auction'] = Auction_bids::where('type','pre_bid')->with(['user','bidwin'])->get();
            }

            if($req->bid_type == 'Direct-Buy'){
                $data['auction'] = Auction_bids::where('type','direct_buy')->with(['user','bidwin'])->get();
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
