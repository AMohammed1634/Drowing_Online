<?php

namespace App\Http\Controllers;

//use http\Client\Curl\User;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    //
    public function viewProfile($id){
        $user = User::find($id);
        return view('user.profile',compact('user'));
    }
    /*
    public function addImageProfile($id,Request $request){
        $user = User::find($id);
        $this->validate($request,[
            'img' => 'required|image'
        ]);
        if(!$request->hasFile('img')){
            return redirect(route('home'));
        }
        $fileObject = $request->file('img');
        $name = $fileObject->getClientOriginalName();
        $extension = $fileObject->getClientOriginalExtension();
        $fileObject->storeAs('profile_images',$name);
        $user->img = $name;
        $user->save();
        return redirect()->back();
    }*/
}
