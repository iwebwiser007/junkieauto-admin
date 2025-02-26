<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use App\Models\User;
use App\Models\Language;

class LoginController extends Controller
{
    //

    public function view_login()
    {
        $data['language'] = Language::all();
        return view('login.login',$data);
    }

    public function login(Request $req) 
    {
        
        if(auth::User())
        {
            return redirect('dashboard');
        }
        else{
            
            return redirect('login')->with('msg','Please Check Email ID and Password');
        }
        
    }

    public  function check_login(Request $req)
    {
        
        $validate = $req->validate([
            'email'=>'bail| required| email | max:255',
            'password'=>'required',
            ]);
        // return user_login($req);
        
        $data = [
            'email' => $req->email,
            'password' => $req->password,
            'status'=>'0',
            'type'=>'admin'
            
        ];
        
        $user=User::where('email',$req->email)->first();
        
        $remember=$req->has('remember_me')? true : false;
        if (auth::attempt($data,$remember)) {
            $id = auth::user()->id;
            User::where('id',$id)->update(['language' => $req->language]);
            return redirect('dashboard');
            
        } 
        else if($user && $user->status == '2')
        {
            return redirect('login')->with('msg','Sorry. You can not login because you are blocked by the Admin');
        }
        else 
        {
            if($user)
            {
                return redirect('login')->with('msg','Please Check Email ID and Password');
            }
            else
            {
                return redirect('login')->with('msg','Email not found');
                
            }
        }
        
    }


    // Logout
    public function logout(){
        auth::logout();
        return redirect('login');
    }
    



}
