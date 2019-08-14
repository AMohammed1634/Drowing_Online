<?php

namespace App\Http\Controllers;


use App\category;
use App\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index(){
        $products = product::paginate(9);
        return view('user.allProducts',compact('products'));
        //return $product;
    }
    public function show(product $product){

        return view('user.singleProduct',compact('product'));
    }
}
