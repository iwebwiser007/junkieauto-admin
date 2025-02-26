<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auction;
use App\Models\Category;
use App\Models\Filter_list;
use App\Models\Filter_translation;
use App\Models\Filter_lable;
class SettingController extends Controller
{
    public function general()
    {
        $data['filter_lable'] = Filter_lable::where('language',user()->language)->with('translation')->get();
        $data['filter_translations'] = Filter_translation::with('list','label')->get();
        $data['auctions'] = Auction::all();
        return view('setting.general',$data);
    }

    //add status
    public function add_filter(Request $req){
        
        $tabname = strtolower(str_replace(' ','_',$req->tab_name));
        
        $search_brand = Filter_list::where('type',$tabname)->get();
        if(count($search_brand) > 0){
            $msg='Brand already exists.';
            $tab_id = Filter_list::where('type',$tabname)->first()->id;
            $search_tab = Filter_lable::where('label_name',$tabname)->where('filter_id',$tab_id)->where('language',user()->language)->get();
            if(count($search_tab) > 0){
                return ;
            } else{
              Filter_lable::create([
                    'filter_id' => $tab_id,
                    'label_name' => $req->tab_name,
                    'language' => user()->language
                ]);
                
            }
           
            return redirect('/general')->with($msg);
        } else{
           $tab_id = Filter_list::create([
                'type' => $tabname,
            ])->id;
            
            $search_tab = Filter_lable::where('label_name',$tabname)->where('filter_id',$tab_id)->where('language',user()->language)->get();
            
            Filter_lable::create([
                'filter_id' => $tab_id,
                'label_name' => $req->tab_name,
                'language' => user()->language
            ]);
            
            
            return redirect('/general');
        }
        
    }


    //add general tab subtype
    public function add_type(Request $req){
        
        $search_brand = Filter_translation::where('filter_id',$req->tab)->where('name',$req->type)->where('language',user()->language)->get();
        
        if(count($search_brand) > 0){
            $msg='Translation already exists.';
            
        } else{
            Filter_translation::create([
                'filter_id' => $req->tab,
                'name' => $req->type,
                'language'=> user()->language,
            ]);
            $msg = 'Added successfully';
            
        }
        return redirect('/general')->with('msg',$msg);
        
    }

    //edit general tab
    public function edit_filter(Request $req){
        $check = Filter_lable::where('label_name',$req->edit_tab_name)->where('language',user()->language)->get();
        if(count($check) == '0'){
            Filter_lable::where('filter_id',$req->edit_label_input)->update([
                'label_name' => $req->edit_tab_name
            ]);
            $msg = "Edited successfully";
        } else{
            $msg = "Already exists";
        }
        return redirect('general')->with('msg',$msg);
        
    }

    //edit translation tab
    public function edit_translation(Request $req){
        $check = Filter_translation::where('name',$req->translation_name)->get();
        if(count($check) == '0'){
            Filter_translation::where('id',$req->edit_trans_input)->update([
                'name' => $req->translation_name,
            ]);
            $msg = 'Added successfully';
        }
        else{
            $msg = 'Already exists';
        }
        
        return redirect('general')->with('msg',$msg);
    }

    //view translation cars
    public function translation_cars($id, $type){

        $trans = Filter_list::where('id',$type)->first('type');
        
        $data['headname'] = Filter_translation::where('id',$id)->first('name');
        $data['auction'] = Auction::whereNotIn('status',['1'])->where($trans->type,$id)->with('user')->get();
        
        return view('setting.translation_cars',$data);

    }

    //show hide translation
    public function show_translation(Request $req){
        
        if($req->trans_status == '1'){
            
            $auction = count(Auction::where($req->list_type , $req->view_trans_id)->get());
            if($auction == '0'){
                Filter_translation::where('id',$req->view_trans_id)->update([
                    'status'=>'0'
                ]);
                
                $msg = 'Blocked successfully';
            }
            else{
                $msg = 'This translation is alreday in use, so you can not block this translation';
            }

        } else{
            Filter_translation::where('id',$req->view_trans_id)->update([
                'status'=>'1'
            ]);
            
            $msg = 'Unblocked successfully';
        }
        return redirect('general')->with('msg',$msg);
    }

    


}
