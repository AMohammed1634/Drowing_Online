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
        $lastOreders = order::latest('id')->limit(4)->get();
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
        $orders = order::all();
        return view('admin.orders',compact('orders'));
        return order::all();
    }

    /**
     * @param order $order
     * show an single Order
     */
    public function singleOrder(order $order){


        return view('admin.singleOrder',compact('order'));
    }

    public function sales(){
        $carts = shoppingCart::paginate(9);
        $orders = order::all()->count();
        $users = User::where('role_id',1)->get()->count();
        $admins = User::where('role_id',3)->get()->count();
        //return $carts;
        return view('admin.sales',compact('carts','users','admins','orders'));

    }

    public function registration(){
        $users = User::paginate(9);
        //DB::table('users')->paginate(9)->get()
        return view('admin.users',compact('users'));
        return User::all();
    }

    public function admin(){

    }


    public function lockscreen(){
        return view('admin.lockscreen');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function lockscreenLogin(Request $request){
        if(Hash::check($request->password,auth()->user()->password)  ){

            return redirect()->action('AdminController@dashboard');
        }
        return redirect()->back();
    }

    public function searchUser(Request $request){

        $users = DB::select("SELECT * FROM `users` WHERE name LIKE \"$request->name%\"");
        $name = $request->name;
        //dd($user);
        return view('admin.users',compact('users','name'));
    }
    public function update(Request  $request , User $user){
        //dd($request->all(),$user);
        $user->role_id = $request->update;
        $user->save();
        return redirect()->back();
    }
    public function userProfile(User $user){
        return view('admin.profile',compact('user'));
    }
}
