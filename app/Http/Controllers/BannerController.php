<?php

namespace App\Http\Controllers;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class BannerController extends Controller
{
    //

    public function banner(){
        $data['banner'] = Banner::latest()->get();
        return view('banner.banner',$data);
    }

    public function add_banner(){
        return view('banner.add_banner');
    }

    public function add_banner_submit(Request $req){
        
        $req->validate([
            'banner_title'=>'required',
            'banner_desc'=>'required',
            'banner_img'=>'bail | required | image | mimes:jpg,png,jpeg,svg | max:1024',
            ]);
            
        if($req->banner_img == ''){
            $val = $req->imgreg;
        }else{
            $val = $req->banner_img;
        }
        
        $name = rand() . '_junkieauto_.' . $val->getClientOriginalName();
        $path =  $val->storeAs('public/images', $name);
        $new_name = url('/') . '/public' . Storage::url($path);
        
        Banner::create([
            'title' => $req->banner_title,
            'description' => $req->banner_desc,
            'image_path'=> $new_name
        ]);
        return redirect('banner');
    }

    public function delete_banner(Request $req){
        Banner::where('id',$req->banner_id)->delete();
        return redirect('banner');
    }

    public function edit_banner(Request $req){
        if($req->banner_img != ''){
            $req->validate([
            'banner_title'=>'required',
            'banner_desc'=>'required',
            'banner_img'=>'bail | required | image | mimes:jpg,png,jpeg,svg | max:1024',
            ]);
            $val = $req->banner_img;
            $name = rand() . '_junkieauto_.' . $val->getClientOriginalName();
            $path =  $val->storeAs('public/images', $name);
            $new_name = url('/') . '/public' . Storage::url($path);
            Banner::where('id',$req->banner)->update([
                'title' => $req->banner_title,
                'description' => $req->banner_desc,
                'image_path'=> $new_name
            ]);
        }else{
            $req->validate([
            'banner_title'=>'required',
            'banner_desc'=>'required',
            
            ]);
            
            Banner::where('id',$req->banner)->update([
                'title' => $req->banner_title,
                'description' => $req->banner_desc,
            ]);

        }
        
        
        return redirect('banner');
    }

    public function show_banner(Request $req){
        
        Banner::where('id',$req->view_banner_id)->update([
            'status'=> $req->banner_status
        ]);
        
        if($req->banner_status == '0'){
            $msg = 'Banner Blocked successfully';
        } else{
            $msg = 'Banner Unblocked successfully';
        }
        return redirect('banner')->with('msg',$msg);
    }

    public function edit_banner_id($id){
        $data['ban'] = Banner::where('id',$id)->first();
        return view('banner.edit_banner',$data);
    }

}
