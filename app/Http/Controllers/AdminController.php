<?php

namespace App\Http\Controllers;

use App\order;
use App\product;
use App\shoppingCart;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function dashboard(){
        $orders = order::all();
        $lastOreders = order::latest('id')->get();
        $lastProduct = product::latest('id')->limit(4)->get();
        //dd($lastProduct);
        //dd($lastOreders);
        $carts = shoppingCart::where(['ordered'=>0])->get();
        $users = User::where('role_id',1)->get();
        $admins = User::where('role_id',3)->get();
        return view('admin.dashboard',compact('orders','carts','users','admins','lastOreders','lastProduct'));
    }

    /**
     * to preform an all orders
     */
    public function orders(){

    }

    public function sales(){

    }

    public function registration(){

    }

    public function admin(){

    }


    public function lockscreen(){
        return view('admin.lockscreen');
    }

    public function lockscreenLogin(Request $request){
        if(Hash::check($request->password,auth()->user()->password)  ){

            return redirect()->action('AdminController@dashboard');
        }
        return redirect()->back();
    }
}
