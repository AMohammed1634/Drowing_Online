@extends('masterView')
@section('body')
    <!--================Home Banner Area =================-->
    <section class="banner_area" style="margin-top: 200px">
        <div class="banner_inner d-flex align-items-center">
            <div class="container" style="position: relative">
                <div class="banner_content text-center">
                    <h2>{{$user->name}}</h2>
                    <div class="page_link">
                        <a href="{{route('home')}}">Home</a>
                        <a href="{{route('viewProfile',$user->id)}}">{{$user->name}}</a>

                    </div>
                </div>
                <div style="position: absolute; top:100px;right: 0;width:172px;height: 172px;
                border-radius: 50%;">
                    <div class="" >
                        <img src="/storage/profile_images/{{$user->img}}" alt=""
                             style="width: 168px;height: 168px; border-radius: 50%;  border: 4px solid #FFF;" id="img">
                    </div>
                    <style>
                        form{
                            position: absolute;
                            top: 68px;
                            left: 14px;
                            z-index: -1;
                            opacity: 0;
                            display: none;
                        }
                    </style>
                    @if(Auth::check() &&Auth::user()->id === $user->id)
                        <form action="{{route('addImageProfile',$user->id)}}" id="form" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            Select Image <input type="file" name="img" id="file">
                            <input type="submit" value="Change">
                        </form>
                    @endif
                    <script>
                        var file = document.getElementById('file');
                        var img = document.getElementById('img');
                        img.onclick = function () {
                            file.click();
                        }
                        img.onmouseover = function(){
                            img.style.cursor = "pointer";
                            img.style.opacity = 0.5;
                        }
                        img.onmouseleave = function (){
                            img.style.opacity = 1;
                        }
                        file.onchange = function () {
                            console.log(document.getElementById('form'));
                            document.getElementById('form').submit();
                        }
                    </script>
                </div>


            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->



  <!--================Category Product Area =================-->
  <section class="cat_product_area p_120">
    <div class="container">
      <div class="row flex-row-reverse">
        <div class="col-lg-9">
          {{-- Title Par  --}}
          <div class="product_top_bar" style="height:60px;">


          </div>
          <div class="latest_product_inner row" id="container">


            {{--  --}}


            <!--================Checkout Area =================-->
            <section class="checkout_area p_120" style="padding-top:0px;margin:auto;" id='content'>
              <div class="container">


                <div class="billing_details">
                  <h2 class="title" style="text-align:center;">My Orders</h2>

                </div>
              </div>
            </section>
            <!--================End Checkout Area =================-->
            <section class="checkout_area p_120" style="padding-top:0px;margin:auto;" id='content1'>
              <div class="container">

                ASD
                <div class="billing_details">
                  {{--  --}}
                  <h2 class="title" style="text-align:center;">Shopping Carts</h2>
                  <div class="latest_product_inner row">
                    @foreach ($user->shoppingCart as $cart)

                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="f_p_item">
                                <div class="f_p_img">
                                    <img class="img-fluid" src="/product_images/{{$cart->product_1->img}}" alt="">
                                    <div class="p_icon">
                                      <style>
                                          .f_p_item .f_p_img .p_icon a.active {
                                              color: #fff;
                                              background: #c5322d;
                                          }
                                      </style>
                                        <a ><i class="lnr lnr-heart"></i></a>
                                        <a class="active"><i class="lnr lnr-cart"></i></a>
                                    </div>
                                </div>
                                <a href="/viewProduct/{{$cart->product_1->id}}"><h4>{{$cart->product_1->name}}</h4></a>
                                <h5>${{$cart->product_1->price}}</h5>
                            </div>
                        </div>
                    @endforeach
                  </div>
                  {{--  --}}
                </div>
              </div>
            </section>
            <!--================End Checkout Area =================-->
            {{--  --}}
            <!--================Checkout Area =================-->
            <section class="checkout_area p_120" style="padding-top:0px;margin:auto;" id='content2'>
              <div class="container">


                <div class="billing_details">
                  <h2 class="title" style="text-align:center;">Recommended Items</h2>
                  <div class="row">
                    <?php
                      $user = App\User::where('id','=',auth()->user()->id)->first();
                    ?>

                    @foreach($user->wishList as $item)
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="f_p_item">
                                    <div class="f_p_img">
                                        <img class="img-fluid" src="/product_images/{{$item->product->img}}" alt="">
                                        <div class="p_icon">
                                            <a href="@if(Auth::check()){{route('addWishList',$item->product->id)}}
                                            @else{{route('login')}}
                                            @endif" class="wishList">
                                                <i class="lnr lnr-heart"></i>
                                            </a>{{-- {{route('addWishList',$pro->id)}} --}}
                                            <a href="@if(Auth::check()){{route('addToCart',Auth::user()->id)}}
                                            @else{{route('login')}}
                                            @endif">
                                                <i class="lnr lnr-cart"></i></a>
                                        </div>
                                    </div>
                                    <a href="/viewProduct/{{$item->product->id}}"><h4>{{$item->product->name}}</h4></a>
                                    <h5>$
                                        @if($item->product->discounted_price !=0)

                                            {{$item->product->discounted_price}}
                                        @else
                                            {{$item->product->price}}
                                        @endif
                                    </h5>
                                </div>
                            </div>
                    @endforeach
                    {{--
                    <div class="latest_product_inner row">
                      @foreach ($user->review->product as $product)

                          <div class="col-lg-4 col-md-4 col-sm-6">
                              <div class="f_p_item">
                                  <div class="f_p_img">
                                      <img class="img-fluid" src="/product_images/{{$cart->product_1->img}}" alt="">
                                      <div class="p_icon">
                                        <style>
                                            .f_p_item .f_p_img .p_icon a.active {
                                                color: #fff;
                                                background: #c5322d;
                                            }
                                        </style>
                                          <a ><i class="lnr lnr-heart"></i></a>
                                          <a class="active"><i class="lnr lnr-cart"></i></a>
                                      </div>
                                  </div>
                                  <a href="/viewProduct/{{$cart->product_1->id}}"><h4>{{$cart->product_1->name}}</h4></a>
                                  <h5>${{$cart->product_1->price}}</h5>
                              </div>
                          </div>
                      @endforeach
                    </div>

                    {{--  --}}
                  </div>
                </div>
              </div>
            </section>
            <!--================End Checkout Area =================-->

      </div>
        </div>
        {{-- left side in profile --}}
        <div class="col-lg-3">
          <div class="left_sidebar_area">
            <aside class="left_widgets cat_widgets">
              <div class="l_w_title">
                <h3>Browse Categories</h3>
              </div>
              <div class="widgets_inner">
                <ul class="list">
                  <li><a  id="order">My Orders</a></li>
                  <li><a  id="carts">Shopping Carts</a></li>
                  <li><a  id="item">Recommended Item</a></li>{{-- show Items User Review It  --}}
                  <li><a href="{{ route('viewProfile',$user->id) }}">Account</a></li>
                  {{--
                  <li>
                    <a href="#">Meat and Fish</a>

                    <ul class="list">
                      <li><a href="#">Frozen Fish</a></li>
                      <li><a href="#">Dried Fish</a></li>
                      <li><a href="#">Fresh Fish</a></li>
                      <li><a href="#">Meat Alternatives</a></li>
                      <li><a href="#">Meat</a></li>
                    </ul>

                  </li>
                    --}}
                    <script>
                      "use strict";
                        var order = document.getElementById('order');
                        var carts = document.getElementById('carts');
                        var item = document.getElementById('item');
                        var container = document.getElementById('container');
                        var content_order = document.getElementById('content');
                        var content_carts = document.getElementById('content1');
                        var content_recommended = document.getElementById('content2');
                        order.style.color = "#F00";
                        content_carts.style.display = "none";
                        content_recommended.style.display = "none";
                        order.onclick = function(){
                            order.style.color = "#F00";
                            carts.style.color = "#877bff";
                            item.style.color = "#877bff";
                            container.innerHTML = '<section class="checkout_area p_120" style="padding-top:0px;margin:auto;" id="content">'
                                    +content_order.innerHTML+"</section>";
                            content_carts.style.display = "none";
                            content_recommended.style.display = "none";
                            //content_carts.style.display = "block";
                        }
                        carts.onclick = function(){
                            content_carts.style.display = "block";
                            order.style.color = "#877bff";
                            carts.style.color = "#F00";
                            item.style.color = "#877bff";
                            container.innerHTML = '<section class="checkout_area p_120" style="padding-top:0px;margin:auto;" id="content1">'
                                    +content_carts.innerHTML+"</section>";
                            console.log(content_carts.innerHTML);
                            content_order.style.display = "none";
                            content_recommended.style.display = "none";

                        }
                        item.onclick = function(){
                            content_recommended.style.display = "block";
                            order.style.color = "#877bff";
                            carts.style.color = "#877bff";
                            item.style.color = "#F00";
                            container.innerHTML = '<section class="checkout_area p_120" style="padding-top:0px;margin:auto;" id="content2">'
                                    +content_recommended.innerHTML+"</section>";
                        }
                    </script>
                </ul>
              </div>
            </aside>

          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================End Category Product Area =================-->
@endsection
