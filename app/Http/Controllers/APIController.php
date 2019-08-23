<?php

namespace App\Http\Controllers;

use App\Http\Resources\productCollection;
use App\product;
use Illuminate\Http\Request;

class APIController extends Controller
{
    //
    public function AllProducts(){
        return productCollection::collection(product::all());
    }
    public function Product(product $product){

        return new productCollection($product);
    }
    public function createProduct(Request $request){


        return new productCollection(product::create($request->all()));
    }
}
