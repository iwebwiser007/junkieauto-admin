<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auction;
use App\Models\Auction_bids;
use App\Models\User;
use App\Models\Auction_media;
use Carbon\Carbon;


class AuctionController extends Controller
{
    //

    public function all_auction(Request $req)
    {  
        $current = now()->format('Y-m-d');
        
        
        
        if($req != ''){
            $data['headname'] = $req->auc_type;
            if($req->auc_type == 'Active Auction'){
                $data['auction'] = Auction::where('status','2')->whereDate('bid_end','>',$current)->with(['user','models','makes','bids'])->latest()->get();
            }

            if($req->auc_type == 'Expired Auction'){
                $data['auction'] = Auction::where('status','2')->with(['user','models','makes','bids'])->whereDate('bid_end','<',$current)->latest()->get();
            }

            if($req->auc_type == 'Sold Auction'){
                $data['auction'] = Auction::where('status','3')->with(['user','models','makes','bids'])->latest()->get();
            }

            if($req->auc_type == 'Rejected Auction'){
                $data['auction'] = Auction::where('status','0')->with(['user','models','makes','bids'])->latest()->get();
            }

            if($req->auc_type == 'Closed Auction'){
                $data['auction'] = Auction::where('status','5')->with(['user','models','makes','bids'])->latest()->get();
            }

            if($req->auc_type == 'Latest Offer'){
                $data['auction'] = Auction::where('status','2')->where('latest_offer','1')->with(['user','models','makes','bids'])->latest()->get();
            }

            if($req->auc_type == 'Top Auction'){
                //$data['auction'] = Auction_bids::select('user_id',DB::raw('count(user_id) as a'))->groupBy('auction_id')->latest()->get();

                $data['auction'] = Auction::where('status','2')->withCount('bids')->with(['user','models','bids'])->latest('bids_count')->get();

            }

            if($req->auc_type == 'All Auction' || $req->auc_type == ''){
                $data['headname'] = 'All Auction';
                $data['auction'] = Auction::whereNotIn('status',['1'])->with(['user','models','makes','bids'])->latest()->get();
            }

        }
            

        
        
        
        return view('auction.all_auction',$data);
    }

    public function request_auction()
    {
        $data['auction_req'] = Auction::where('status','1')->with(['user','models','makes'])->latest()->get();
        return view('auction.request_auction', $data);
    }

    public function accept_auc_req(Request $req)
    {
        
        Auction::where('id',$req->acc_req_id)->update([
            'status' => '2',
        ]);

        $data=Auction::where('id',$req->acc_req_id)->first();
        
        $user_msgs='Your auction request is accepted by admin';
        $user=User::where('id',$data->user_id)->first();
        
        // $user=User::where('id','5')->first();
        
        $user_title='Junkie Auto';
        $type='Auction accepted';
        $image='';
           
        notification_web($user_msgs,$user, $user_title);
        
        notification_app($user_msgs,$user, $user_title,$type,$data->id,$image);

        return redirect('request_auction');
    }

    public function reject_auc_req(Request $req){
        
        Auction::where('id',$req->rej_req_id)->update([
            'status' => '0',
            'cancel_reason' => $req->req_reason,
        ]);

        $data=Auction::where('id',$req->rej_req_id)->first();
        
        $user_msgs=$req->req_reason;
        $user=User::where('id',$data->user_id)->first();
        $type='Auction rejected';
        $image='';
        $user_title='Junkie Auto';
            
            // notification_web($user_msg,$user, $user_title,$type,'admin');
        notification_app($user_msgs,$user, $user_title,$type,$data->id,$image);

        return redirect('request_auction');
    }

    public function auction_detail($id){
        
        $data['auction'] = Auction::where('id',$id)->with(['user','category_translation','models','makes','uses','statuses','colors','fuels','transmissions','catalytics','bodies','sec_damages','drivelines','damages'])->first();
        $data['bids'] = Auction_bids::where('auction_id',$id)->with('user')->latest()->get();
        $data['winner'] = Auction_bids::where('auction_id',$id)->where('status','2')->with('user')->first();
        return view('auction.auction_detail',$data);
    }

    public function latest_offer(Request $req){
        Auction::where('id',$req->tab_id)->update([
            'latest_offer' => '1',
        ]);

        $data=Auction_media::where('auction_id',$req->tab_id)->where('type','image')->first();
        
        $all=User::where('status','1')->get();
        
        
        foreach($all as $item)
        {
            $user_msgs='New auction is added in latest offer';
            $user=$item;
            $type='latest Aution';
            $user_title='Junkie Auto';
            $image=$data->media_url ?? '';
        
                
                // notification_web($user_msg,$user, $user_title,$type,'admin');
            notification_app($user_msgs,$user, $user_title,$type,$req->tab_id,(string)$image);
                
        }

        return redirect('all_auction');
    }


}
