<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    //
    public function profile(){
        
        return view('profile');
    }

    public function edit_profile(Request $req){
        
        User::where('id',user()->id)->update([
            'first_name' => $req->first_name,
            'last_name' => $req->last_name,
            'email' => $req->email,
            'mobile_number'=>$req->mobile,
            'address' => $req->address,
            'street' => $req->street,
            'city' => $req->city,
            'state' => $req->state,
            'country' => $req->country,
            
        ]);
        return redirect('profile');
    }

    public function edit_password(Request $req){
        $pass = Hash::make($req->password);
        User::where('id',user()->id)->update([
            'password'=>$pass,
        ]);
        return redirect('profile');
    }

}
