<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Auction;
use App\Models\Auction_bids;
use App\Models\Earning;
use App\Models\Document_extra_fields;
use App\Models\Document_files;
use Illuminate\Support\Facades\DB;

class SellerController extends Controller
{
    //

    public function all_seller(Request $req)
    { 
        if($req != ''){
            $data['headname'] = $req->seller_type;
            if($req->seller_type == 'Active Seller'){
                $data['seller'] = User::whereIn('status',['1'])->where('type','!=','admin')->with('dealer')->latest()->get();
            }

            if($req->seller_type == 'Rejected Seller'){
                $data['seller'] = User::whereIn('status',['2'])->where('type','!=','admin')->with('dealer')->latest()->get();
            }

            if($req->seller_type == 'Top Seller'){
                $data['seller'] = Auction_bids::with(['user','dealer'])->select('user_id',DB::raw('sum(bid_amount) as a'))->groupBy('user_id')->get();
            }

            if($req->seller_type == 'Top Dealer'){

                $data['dealer'] = Earning::with(['user'])->select('user_id',DB::raw('sum(bid_amount) as a'))->groupBy('user_id')->get();

            }

            if($req->seller_type == 'All Dealer'){
                
                
                $data['dealer'] = Earning::with(['user'])->get();
            }
            
            if($req->seller_type == 'All Seller' || $req->seller_type == ''){
                $data['headname'] = 'All Seller';
                $data['seller'] = User::whereNotIn('status',['0'])->where('type','!=','admin')->with('dealer')->latest()->get();
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
            
            if($req->auc_type == 'Expired Auction'){
                $data['auction'] = Auction::where('user_id',$id)->where('status','6')->with(['user','models','makes'])->latest()->get();
            }

            if($req->auc_type == 'All Auction' || $req->auc_type == ''){
                $data['headname'] = 'All Auction';
                $data['auction'] = Auction::where('user_id',$id)->with(['user','models','makes'])->latest()->get();
            }

        }
        

        return view('seller.sellerdetail',$data);
    }

    public function seller_req(){
        $data['seller_req'] = User::where('status','0')->where('type','!=','admin')->latest()->get();
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
            
        notification_web($user_msgs,$user, $user_title);
        notification_app($user_msgs,$user, $user_title,$type,$user->id,$image);

        return back();
        // return redirect('seller_req');
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
            
        notification_web($user_msgs,$user, $user_title);
        notification_app($user_msgs,$user, $user_title,$type,$user->id,$image);
        
        return back();
        // return redirect('seller_req');
    }
    
    
    public function document_req(){
        $data['document_req'] = Document_files::where('status','0')->latest()->get();
    
        return view('seller.document_req',$data) ;
    }
    
    
    public function accept_seller_docs(Request $req){
        
        Document_files::where('id',$req->acc_docs_id)->update([
            'status' => '1',
        ]);
        
        $user_id = Document_files::where('id',$req->acc_docs_id)->first();
        $user_msgs='Your document request is accepted by admin';
        
        Document_extra_fields::where('user_id',$user_id->user_id)->update([
            'status' => '1',
        ]);
        
        $user=User::where('id',$user_id->user_id)->first();
        $type='User document verify';
        $user_title='Junkie Auto';
        $image='';
            
        notification_web($user_msgs,$user, $user_title);
        notification_app($user_msgs,$user, $user_title,$type,$user->id,$image);

        return back();
        // return redirect('seller_req');
    }

    public function reject_seller_docs(Request $req){
        
        Document_files::where('id',$req->rej_docs_id)->update([
            'status' => '2',
            'cancel_resonse' => $req->docs_reason,
        ]);

        $user_id = Document_files::where('id',$req->rej_docs_id)->first();
        $user_msgs=$req->docs_reason;
        $user=User::where('id',$user_id->user_id)->first();
        $type='Seller Documents rejected';
        $user_title='Junkie Auto';
        $image='';
            
        notification_web($user_msgs,$user, $user_title);
        notification_app($user_msgs,$user, $user_title,$type,$user->id,$image);
        
        return back();
        // return redirect('seller_req');
    }

}
