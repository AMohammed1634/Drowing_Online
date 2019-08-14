<?php

namespace App\Http\Controllers;

use App\category;
use App\product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index(){

        $cats = category::all();
        return view('user.Products',compact('cats'));
    }
    public function show(category $cat){
        $products = product::where('category_id',$cat->id)->paginate(9);
        $cats = category::all();
        //return $products;
        return view('user.singleCat',compact('products','cats'));
    }
}
