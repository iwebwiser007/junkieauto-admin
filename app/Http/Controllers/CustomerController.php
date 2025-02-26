<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CustomerController extends Controller
{
    //

    public function all_deal()
    {
        return view('customer.all_cust');
    }

    public function cust()
    {
        return view('customer.cust');
    }

    public function ind_deal()
    {
        return view('customer.ind_cust');
    }

    public function buss_deal()
    {
        $data['seller'] = User::where('type','!=','admin')->get();
        return view('customer.buss_cust',$data);
    }

    public function delaer_req()
    {
        return view('customer.delaer_req');
    }

    public function cust_detail()
    {
        return view('customer.cust_detail');
    }

    public function dealer_detail($id)
    {
        $data['dealer'] = User::where('id',$id)->first();
        return view('customer.delear_detail');
    }

}
