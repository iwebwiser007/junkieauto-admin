<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Make;
use App\Models\Category;
use App\Models\Category_translation;
use App\Models\Auction;

class MakeController extends Controller
{
    //
    public function makes(){
        $make = Category::where('is_parent','0')->get('id');
        
        $data['makes'] = Category::where('is_parent','0')->with('brands')->withCount('sub_cat','cars')->get();
        
        return view('make.make',$data);
    }

    public function add_make(Request $req){
        
        $req->validate([
            'make_name'=>'required',
            
            ]);
        
        $check = Category_translation::where('name',$req->make_name)->where('language',user()->language)->get();
        
        if(count($check) == '0'){
            $id = Category::create([
                'is_parent'=> '0',
                'status'=>'1'
            ])->id;
    
            Category_translation::create([
                'caregory_id'=> $id,
                'name'=>$req->make_name,
                'language'=>user()->language
            ]);
            $msg = 'Make added successfully';
        }
        else {
            $msg = 'Make already exists';
        }
       
        return redirect('make')->with('msg',$msg);
    }

    public function models($id){
        
        $data['brand'] = Category_translation::where('caregory_id',$id)->where('language',user()->language)->first();
        $cat_id = Category::where('is_parent',$id)->get('id'); 
        
        $data['models'] = Category_translation::whereIn('caregory_id',$cat_id)->withCount('cars_model')->with('make_models')->where('language',user()->language)->get();
        //$data['models'] = Category::where('is_parent',$id)->with('models')->withCount('cars_model')->get();

        return view('make.models',$data); 
    }

    public function add_model(Request $req){
        
        $req->validate([
            'make_name'=>'required',
            
            ]);
            
        $check = Category_translation::where('caregory_id',$req->view_model_id)->where('name',$req->make_name)->where('language',user()->language)->get();
        if(count($check)=='0'){
            $id = Category::create([
                'is_parent'=> $req->brand_id,
                'status'=>'1'
            ])->id;
    
            Category_translation::create([
                'caregory_id'=> $id,
                'name'=>$req->make_name,
                'language'=>user()->language
            ]);
            $msg = "Model added successfully";
        } else{
            $msg = "Model already exists";
        }
        return redirect('models/'.$req->brand_id)->with('msg',$msg);
         
     }

    public function all_cars($id, Request $req){

        if($req != ''){
            $data['headname'] = $req->auc_type;
            if($req->auc_type == 'Active Auction'){
                $data['all'] = Auction::where('status','2')->where('model',$id)->with('user')->latest()->get();
            }

            if($req->auc_type == 'Sold Auction'){
                $data['all'] = Auction::where('status','3')->where('model',$id)->with('user')->latest()->get();
            }

            if($req->auc_type == 'Cancelled Auction'){
                
                $data['all'] = Auction::where('status','0')->where('model',$id)->with('user')->latest()->get();
            }

            if($req->auc_type == 'Closed Auction'){
                $data['all'] = Auction::where('status','4')->where('model',$id)->with('user')->latest()->get();
            }

            if($req->auc_type == 'All Auction' || $req->auc_type == ''){
                $data['headname'] = 'All Auction';
                $data['all'] = Auction::whereNotIn('status',['1'])->where('model',$id)->with('user')->latest()->get();
            }

        }
         $data['model'] = Category_translation::where('caregory_id',$id)->where('language',user()->language)->first();
         //$data['all'] = Auction::whereNotIn('status',['1'])->where('model',$id)->with('user')->latest()->get();
         return view('make.carsbymodel',$data);
    }

    public function cars_by_make($id, Request $req){

        if($req != ''){
            $data['headname'] = $req->auc_type;
            if($req->auc_type == 'Active Auction'){
                $data['all'] = Auction::where('status','2')->where('make',$id)->with('user','models')->latest()->get();
            }

            if($req->auc_type == 'Sold Auction'){
                $data['all'] = Auction::where('status','3')->where('make',$id)->with('user','models')->latest()->get();
            }

            if($req->auc_type == 'Cancelled Auction'){
                
                $data['all'] = Auction::where('status','0')->where('make',$id)->with('user','models')->latest()->get();
            }

            if($req->auc_type == 'Closed Auction'){
                $data['all'] = Auction::where('status','4')->where('make',$id)->with('user','models')->latest()->get();
            }

            if($req->auc_type == 'All Auction' || $req->auc_type == ''){
                $data['headname'] = 'All Auction';
                $data['all'] = Auction::whereNotIn('status',['1'])->where('make',$id)->with('user','models')->latest()->get();
            }

        }

        $data['brand'] = Category_translation::where('caregory_id',$id)->where('language',user()->language)->first();
        //$data['all'] = Auction::whereNotIn('status',['1'])->where('make',$id)->with('user','models')->get();
        return view('make.cars_by_brand',$data);
    }

    public function show_make(Request $req){
        
        if($req->make_status == '1'){
            //$cat_trans = Category_translation::where('caregory_id',$req->view_make_id)->get('id');
            $auction = count(Auction::where('make',$req->view_make_id)->get());
            if($auction == '0'){
                Category::where('id',$req->view_make_id)->update([
                    'status'=>'0'
                ]);
                Category::where('is_parent',$req->view_make_id)->update([
                    'status'=>'0'
                ]);
                $msg = 'Make and their Models Blocked successfully';
            }
            else{
                $msg = 'This make is already in use, so you can not block this make';
            }

        } else{
            Category::where('id',$req->view_make_id)->update([
                'status'=>'1'
            ]);
            Category::where('is_parent',$req->view_make_id)->update([
                'status'=>'1'
            ]);
            $msg = 'Make and their Models Unblocked successfully';
        }
        return redirect('make')->with('msg',$msg);
    }

    public function show_model(Request $req, $id){
        $parent = Category::where('id',$req->view_model_id)->get('is_parent');
        if($req->model_status == '1'){
            //$cat_trans = Category_translation::where('caregory_id',$req->view_model_id)->get('id');
            //return $cat_trans;
            $auction = count(Auction::where('model',$req->view_model_id)->get());
            
            if($auction == '0'){
                Category::where('id',$req->view_model_id)->update([
                    'status'=>'0'
                ]);
                $msg = 'Model blocked successfully';
            }
            else{
                $msg = 'This model is already in use, so you can not block this model';
            }

        } else{ 
            
            $make = Category::where('id',$parent[0]->is_parent)->get('status');
            if($make[0]->status == '1'){
                Category::where('id',$req->view_model_id)->update([
                    'status'=>'1'
                ]);
                $msg = 'Model unblocked successfully';

            }
            else{
                $msg = 'Your make is blocked so you can not unblocked this model';
            }
            
        }
        
        return redirect('models/'.$parent[0]->is_parent)->with('msg',$msg);
    }

}
