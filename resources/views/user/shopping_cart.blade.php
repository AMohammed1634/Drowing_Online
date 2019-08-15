@extends('masterView')
@section('body')
<style>
    .price{
        font-size: 19px;
        color: #006fb3;
        font-weight: bold;
    }
    .dis_price{
        color: #D6D6D6;

    }
</style>
<div class="cards" style="margin-top: 150px">
    <div class="container">
        <h2 class="section-title">Shopping Cart	( {{count($carts)}} )</h2>
        <div class="row">
            <div class="col col-lg-8">
                {{--End Card --}}
                <?php
                $i=-1;
                $total = 0;
                ?>
                @foreach($carts as $cart)
                <?php
                $i++;
                if($cart->product->discounted_price == 0){
                    $total += $cart->product->price * $cart->quantity;
                }else{
                    $total += $cart->product->discounted_price * $cart->quantity;
                }
                ?>
                <div class="card mb-3" style="max-width: 100%;">
                    <div class="row no-gutters">
                        <div class="col-md-2">
                            <img src="/product_images/{{$cart->product->img}}" class="card-img" alt="..."
                             style="margin:15px 5px;vertical-align: middle">
                        </div>
                        <div class="col-md-10">
                            <div class="card-body">
                                <h5 class="card-title"><a href="{{route('product.show',$cart->product->id)}}">{{$cart->product->name}}</a> </h5>
                                    <div class="row">
                                    <div class="col-7">
                                        <p class="card-text">
                                            @if($cart->product->discounted_price == 0)
                                                <div class="price">{{$cart->product->price}} USA</div>
                                            @else
                                                <div class="price">{{$cart->product->discounted_price}} USA</div>
                                                <div class="dis_price"><del>{{$cart->product->price}}</del> USA</div>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-5">
                                        <label style="margin: 10px">QTY</label>
                                        <a  style="border-radius: 50%;width: 37px;height: 37px"

                                            onclick="var x = parseInt(document.getElementById('val{{$i}}').value);
                                                        if(x>5){
                                                            return ;
                                                        }
                                                        /**
                                                        *
                                                        */
                                                        var xmlhttp;
                                                        xmlhttp=new XMLHttpRequest();
                                                        xmlhttp.onreadystatechange=function(){
                                                            if (xmlhttp.readyState==4 && xmlhttp.status==200)
                                                            {
                                                                x++ ;
                                                                //alert('val{{$i}}');
                                                                document.getElementById('val{{$i}}').value = x;
                                                            }
                                                        }
                                                        xmlhttp.open('GET','http://127.0.0.1:8000/incrementQTY/{{$cart->id}}' ,true);
                                                        xmlhttp.send();
                                                        "
                                            class="btn btn-light">+</a>
                                        <input type="text"  readonly value="{{$cart->quantity}}" style="margin: 10px;border-radius: 25%;
                                                width:50px;height: 37px" id="val{{$i}}" />
                                        <a   style="border-radius: 50%;width: 37px;height: 37px"

                                             onclick="var x = parseInt(document.getElementById('val{{$i}}').value);
                                                 if(x <= 1){
                                                 return ;
                                                 }
                                                 /**
                                                 *
                                                 */
                                                 var xmlhttp;
                                                 xmlhttp=new XMLHttpRequest();
                                                 xmlhttp.onreadystatechange=function(){
                                                 if (xmlhttp.readyState==4 && xmlhttp.status==200)
                                                     {
                                                         x-- ;
                                                         //alert('val{{$i}}');
                                                         document.getElementById('val{{$i}}').value = x;
                                                     }
                                                 }
                                                 xmlhttp.open('GET','http://127.0.0.1:8000/decrementQTY/{{$cart->id}}' ,true);
                                                 xmlhttp.send();
                                                 "
                                             class="btn btn-light">-</a>
                                    </div>
                                </div>
                                <p class="card-text">{{$cart->product->description}}.</p>
                                <?php
                                $start = \Carbon\Carbon::parse($cart->updated_at);
                                $end = \Carbon\Carbon::parse(\Carbon\Carbon::now());
                                $res = $end->day - $start->day;
                                ?>
                                <p class="card-text"><small>Last Updated From {{$res}} Day\s</small></p>
                            </div>
                            <hr class="">
                            <a href="{{route('shopping_cart.destroy',$cart->id)}}" class="btn btn-outline-danger" style="margin-bottom: 30px">Delete</a>
                            <br>
                        </div>

                    </div>
                </div>
                @endforeach
                {{--End Card --}}
            </div>
            <div class="col col-lg-4">
                <div class="card" style="padding: 6px 10px">
                    <div class="card-title">
                        Total :<br>
                        <span style="font-size: 25px;font-weight: bold">{{$total}}</span> USA
                    </div>
                </div>
                <a href="{{route('shopping_cart.checkout')}}" class="btn btn-success" style="margin-top: 20px;width: 100%;font-size: 25px">PROCEED TO CHECKOUT</a>
            </div>
        </div>
    </div>
</div>
<script>
    var add = document.getElementById('add');
    var sub = document.getElementById('sub');

function add(id){
    var xmlhttp;
    xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            var str=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","http://127.0.0.1:8000/incrementQTY/"+id ,true);
    xmlhttp.send();
}
</script>
@endsection
