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
                ?>
                @foreach($carts as $cart)
                <?php
                $i++;
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
                                            id="add"
                                            onclick="var x = parseInt(document.getElementById('val{{$i}}').value);
                                                        if(x>5){
                                                            return ;
                                                        }
                                                        x++ ;
                                                        //alert('val{{$i}}');
                                                        document.getElementById('val{{$i}}').value = x;"
                                            class="btn btn-light">+</a>
                                        <input type="text"  readonly value="{{$cart->quantity}}" style="margin: 10px;border-radius: 25%;
                                                width:50px;height: 37px" id="val{{$i}}" />
                                        <a   style="border-radius: 50%;width: 37px;height: 37px"
                                           id="sub"
                                             onclick="var x = parseInt(document.getElementById('val{{$i}}').value);
                                                 if(x <= 1){
                                                 return ;
                                                 }
                                                 x-- ;
                                                 //alert('val{{$i}}');
                                                 document.getElementById('val{{$i}}').value = x;"
                                             class="btn btn-light">-</a>
                                    </div>
                                </div>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                {{--End Card --}}
            </div>
            <div class="col col-lg-4">
                asd
            </div>
        </div>
    </div>
</div>
<script>
    var add = document.getElementById('add');
    var sub = document.getElementById('sub');


</script>
@endsection
