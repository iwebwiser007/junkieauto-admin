<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Auction;
use App\Models\Auction_bids;
use App\Models\Document_extra_fields;
use Illuminate\Support\Facades\DB;

class SellerController extends Controller
{
    //

    public function all_seller(Request $req)
    { 
        if($req != ''){
            $data['headname'] = $req->seller_type;
            if($req->seller_type == 'Active Seller'){
                $data['seller'] = User::whereIn('status',['1'])->where('type','!=','admin')->latest()->get();
            }

            if($req->seller_type == 'Rejected Seller'){
                $data['seller'] = User::whereIn('status',['2'])->where('type','!=','admin')->latest()->get();
            }

            if($req->seller_type == 'Top Seller'){
                $data['seller'] = Auction_bids::with(['user'])->select('user_id',DB::raw('sum(bid_amount) as a'))->groupBy('user_id')->get();
            }
            
            if($req->seller_type == 'All Seller' || $req->seller_type == ''){
                $data['headname'] = 'All Seller';
                $data['seller'] = User::whereNotIn('status',['0'])->where('type','!=','admin')->latest()->get();
            }

        }
        
        return view('seller.all_seller',$data);
    }

    public function seller_detail($id, Request $req)
    {
        $data['seller'] = User::where('id',$id)->first();
        $data['media'] = Document_extra_fields::where('user_id',$id)->with('files')->get();
        // $data['auction'] = Auction::where('user_id',$id)->with(['user','models','makes'])->get();
        // $bids = Auction_bids::where('user_id',$id)->get('auction_id');
        // $data['bids'] = Auction::whereIn('id',$bids)->with('user')->latest()->get();

        if($req != ''){
            $data['headname'] = $req->auc_type;
            if($req->auc_type == 'Active Auction'){
                $data['auction'] = Auction::where('user_id',$id)->where('status','2')->with(['user','models','makes'])->latest()->get();
                
            }

            if($req->auc_type == 'Sold Auction'){
                $data['auction'] = Auction::where('user_id',$id)->where('status','3')->with(['user','models','makes'])->latest()->get();
            }

            if($req->auc_type == 'Rejected Auction'){
                $data['auction'] = Auction::where('user_id',$id)->where('status','0')->with(['user','models','makes'])->latest()->get();
            }

            if($req->auc_type == 'Closed Auction'){
                $data['auction'] = Auction::where('user_id',$id)->where('status','5')->with(['user','models','makes'])->latest()->get();
            }

            if($req->auc_type == 'Requested Auction'){
                $data['auction'] = Auction::where('user_id',$id)->where('status','1')->with(['user','models','makes'])->latest()->get();
            }

            if($req->auc_type == 'All Auction' || $req->auc_type == ''){
                $data['headname'] = 'All Auction';
                $data['auction'] = Auction::where('user_id',$id)->with(['user','models','makes'])->latest()->get();
            }

        }
        

        return view('seller.sellerdetail',$data);
    }

    public function seller_req(){
        $data['seller_req'] = User::where('status','0')->where('type','!=','admin')->get();
        return view('seller.seller_req',$data) ;
    }

    public function accept_seller_req(Request $req){
        
        User::where('id',$req->acc_req_id)->update([
            'status' => '1',
        ]);

        $user_msgs='Your request is accepted by admin';
        $user=User::where('id',$req->acc_req_id)->first();
        $type='User verify';
        $user_title='Junkie Auto';
        $image='';
            
            // notification_web($user_msg,$user, $user_title,$type,'admin');
        notification_app($user_msgs,$user, $user_title,$type,$user->id,$image);

        return redirect('seller_req');
    }

    public function reject_seller_req(Request $req){
        
        User::where('id',$req->rej_req_id)->update([
            'status' => '2',
            'cancel_reason' => $req->req_reason,
        ]);

        $user_msgs=$req->req_reason;
        $user=User::where('id',$req->rej_req_id)->first();
        $type='User rejected';
        $user_title='Junkie Auto';
        $image='';
            
            // notification_web($user_msg,$user, $user_title,$type,'admin');
        notification_app($user_msgs,$user, $user_title,$type,$user->id,$image);
        
        return redirect('seller_req');
    }

}
