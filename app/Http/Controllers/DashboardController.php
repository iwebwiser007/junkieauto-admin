<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auction;
use App\Models\Auction_bids;
use App\Models\Earning;
use App\Models\User;
use App\Models\Document_files;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //

    public function view_dashboard()
    {
        $data['top_seller'] = Auction_bids::where('status','2')->with(['user'])->select('user_id',DB::raw('count(bid_amount) as a'))->groupBy('user_id')->limit(12)->get();
        $data['top_dealer'] = Earning::with(['users'])->select('user_id',DB::raw('count(bid_amount) as a'))->groupBy('user_id')->limit(12)->get();
        $data['total_earn'] = Earning::all()->sum('commission_amount');
        $data['total_annual_earn'] = Earning::whereYear('created_at',now()->format('Y'))->sum('commission_amount');
        $data['total_seller'] = User::where('type','!=','admin')->get()->count(); 
        $data['total_auction'] = Auction::count();
        $data['total_bids'] = Auction_bids::count();
        $data['total_dealer'] = Earning::groupBy('user_id')->count();
        
        $data['new_earning'] = Earning::join('auctions','admin_commissions.auction_id','auctions.id')->where('auctions.used_type','8')->whereYear('admin_commissions.created_at',now()->format('Y'))->sum('commission_amount');
        $data['used_earning'] = Earning::join('auctions','admin_commissions.auction_id','auctions.id')->where('auctions.used_type','9')->whereYear('admin_commissions.created_at',now()->format('Y'))->sum('commission_amount');
        $data['junk_earning'] = Earning::join('auctions','admin_commissions.auction_id','auctions.id')->where('auctions.used_type','10')->whereYear('admin_commissions.created_at',now()->format('Y'))->sum('commission_amount');
        
        $data['seller_req'] = User::where('status','0')->where('type','!=','admin')->get()->count();
        $data['document_req'] = Document_files::where('status','0')->get()->count();
        $data['auc_req'] = Auction::where('status','1')->get()->count();
        $data['deals'] = Auction_bids::where('status','2')->whereYear('created_at',now()->format('Y'))->count();

        // Earning
        $earn_last=Earning::whereBetween('created_at', [now()->startOfMonth()->subMonth(), now()->endofMonth()->subMonth()])->whereYear('created_at',now()->format('Y'))->count();
        $earn_latest=Earning::whereBetween('created_at', [now()->startOfMonth(), now()->endofMonth()])->whereYear('created_at',now()->format('Y'))->count();

        $seller_last=User::where('type','!=','admin')->where('status','!=','0')->whereBetween('created_at', [now()->startOfMonth()->subMonth(), now()->endofMonth()->subMonth()])->whereYear('created_at',now()->format('Y'))->count();
        $seller_latest=User::where('type','!=','admin')->where('status','!=','0')->whereBetween('created_at', [now()->startOfMonth(), now()->endofMonth()])->whereYear('created_at',now()->format('Y'))->count();

        $auction_last=Auction::where('status','!=','1')->whereBetween('created_at', [now()->startOfMonth()->subMonth(), now()->endofMonth()->subMonth()])->whereYear('created_at',now()->format('Y'))->count();
        $auction_latest=Auction::where('status','!=','1')->whereBetween('created_at', [now()->startOfMonth(), now()->endofMonth()])->whereYear('created_at',now()->format('Y'))->count();

        $bids_last=Auction_bids::whereBetween('created_at', [now()->startOfMonth()->subMonth(), now()->endofMonth()->subMonth()])->whereYear('created_at',now()->format('Y'))->count();
        $bids_latest=Auction_bids::whereBetween('created_at', [now()->startOfMonth(), now()->endofMonth()])->count();

        $dealer_last=Auction_bids::where('status','2')->whereBetween('created_at', [now()->startOfMonth()->subMonth(), now()->endofMonth()->subMonth()])->whereYear('created_at',now()->format('Y'))->count();
        $dealer_latest=Auction_bids::where('status','2')->whereBetween('created_at', [now()->startOfMonth(), now()->endofMonth()])->whereYear('created_at',now()->format('Y'))->count();
        

        if($earn_last > 0 ){
            $data['earn_result']=(($earn_latest - $earn_last)/ $earn_last) * 100;
        }else{
            $data['earn_result'] = $earn_latest.'0';
        }

        if($seller_last > 0 ){
            if($seller_latest > $seller_last){
                $data['seller_result']=(($seller_latest - $seller_last)/ $seller_last) * 100;    
                //$data['seller_result'] = '0';
            }
            else{
                $data['seller_result'] = '0';
            }
            
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


    //   return now()->format('Y'); 
        
        // charts
        $i=1;
        $cor="";$sel="";$auction="";$bids="";
        while($i!=13)
        {
            $cor.=Earning::whereMonth('created_at', $i)->whereYear('created_at',now()->format('Y'))
                ->get()->sum('commission_amount').',';

            $sel.=count(User::where('type','!=','admin')->where('status','!=','0')->whereMonth('created_at', $i)->whereYear('created_at',now()->format('Y'))
            ->get()).',';
            
            $auction.=count(Auction::whereMonth('created_at', $i)->whereYear('created_at',now()->format('Y'))
                ->get()).',';

            $bids.=count(Auction_bids::whereMonth('created_at', $i)->whereYear('created_at',now()->format('Y'))
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
