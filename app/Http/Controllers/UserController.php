<?php

namespace App\Http\Controllers;

//use http\Client\Curl\User;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    //
    public function viewProfile(User $user){

        return view('user.profile',compact('user'));
    }

    public function addImageProfile(User $user,Request $request){

        $this->validate($request,[
            'img' => 'required|image'
        ]);
        if(!$request->hasFile('img')){
            return redirect()->back();
        }
        $fileObject = $request->file('img');
        $name = $fileObject->getClientOriginalName();
        $extension = $fileObject->getClientOriginalExtension();
        $nameWithoutExt = pathinfo($name,PATHINFO_FILENAME);
        $name = $nameWithoutExt . "_".time().".".$extension;
        $fileObject->storeAs('public\profile_images',$name);
        $user->img = $name;
        $user->save();
        return redirect()->back();
    }
}
