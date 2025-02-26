<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auction;
use App\Models\Auction_bids;
use App\Models\Earning;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //

    public function view_dashboard()
    {
        $data['top_seller'] = Auction_bids::with(['user'])->select('user_id',DB::raw('sum(bid_amount) as a'))->groupBy('user_id')->limit(12)->get();
        $data['top_dealer'] = Earning::with(['users'])->select('user_id',DB::raw('sum(bid_amount) as a'))->groupBy('user_id')->limit(12)->get();
        $data['total_earn'] = Earning::all()->sum('commission_amount');
        $data['total_seller'] = User::where('type','!=','admin')->get()->count(); 
        $data['total_auction'] = Auction::count();
        $data['total_bids'] = Auction_bids::count();
        $data['total_dealer'] = Earning::groupBy('user_id')->count();

        // Earning
        $earn_last=Earning::whereBetween('created_at', [now()->startOfMonth()->subMonth(), now()->endofMonth()->subMonth()])->count();
        $earn_latest=Earning::whereBetween('created_at', [now()->startOfMonth(), now()->endofMonth()])->count();

        $seller_last=User::where('type','!=','admin')->whereBetween('created_at', [now()->startOfYear()->subYear(), now()->endofYear()->subYear()])->count();
        $seller_latest=User::where('type','!=','admin')->whereBetween('created_at', [now()->startOfYear(), now()->endofYear()])->count();

        $auction_last=Auction::whereBetween('created_at', [now()->startOfYear()->subYear(), now()->endofYear()->subYear()])->count();
        $auction_latest=Auction::whereBetween('created_at', [now()->startOfYear(), now()->endofYear()])->count();

        $bids_last=Auction_bids::whereBetween('created_at', [now()->startOfYear()->subYear(), now()->endofYear()->subYear()])->count();
        $bids_latest=Auction_bids::whereBetween('created_at', [now()->startOfYear(), now()->endofYear()])->count();

        $dealer_last=Auction_bids::where('status','2')->whereBetween('created_at', [now()->startOfYear()->subYear(), now()->endofYear()->subYear()])->count();
        $dealer_latest=Auction_bids::where('status','2')->whereBetween('created_at', [now()->startOfYear(), now()->endofYear()])->count();


        if($earn_last > 0 ){
            $data['earn_result']=(($earn_latest - $earn_last)/ $earn_last) * 100;
        }else{
            $data['earn_result'] = $earn_latest.'0';
        }

        if($seller_last > 0 ){
            $data['seller_result']=(($seller_latest - $seller_last)/ $seller_last) * 100;
        }else{
            $data['seller_result'] = $seller_latest.'0';
        }

        if($auction_last > 0 ){
            $data['auction_result']=(($auction_latest - $auction_last)/ $auction_last) * 100;
        }else{
            $data['auction_result'] = $auction_latest.'0';
        }

        if($bids_last > 0 ){
            $data['bids_result']=(($bids_latest - $bids_last)/ $bids_last) * 100;
        }else{
            $data['bids_result'] = $bids_latest.'0';
        }

        if($dealer_last > 0 ){
            $data['dealer_result']=(($dealer_latest - $dealer_last)/ $dealer_last) * 100;
        }else{
            $data['dealer_result'] = $dealer_latest.'0';
        }


        
        
        // charts
        $i=1;
        $cor="";$sel="";$auction="";$bids="";
        while($i!=13)
        {
            $cor.=count(Earning::whereMonth('created_at', $i)
                ->get()).',';

            $sel.=count(User::whereMonth('created_at', $i)
            ->get()).','; 
            
            $auction.=count(Auction::whereMonth('created_at', $i)
                ->get()).',';

            $bids.=count(Auction_bids::whereMonth('created_at', $i)
            ->get()).',';

            
            $i++;
        }
        $data['userData'] =  rtrim($cor,',');
        $data['sellerData'] =  rtrim($sel,',');
        $data['auctionData'] =  rtrim($auction,',');
        $data['bidsData'] =  rtrim($bids,',');

        return view('dashboard.dashboard2',$data);
    }



}
