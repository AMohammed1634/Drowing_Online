@extends('masterView')

@section('body')
    <div class="site-blocks-cover overlay" style="background-image: url(images/hero_2.jpg);"
         data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row align-items-center justify-content-center">

                <div class="col-md-12" data-aos="fade-up" data-aos-delay="400">

                    <div class="row mb-4">
                        <div class="col-md-7">
                            <h1>Shop With Us</h1>
                            <p class="mb-5 lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam assumenda ea quo cupiditate facere deleniti fuga officia.</p>
                            <div>
                                <a href="#" class="btn btn-white btn-outline-white py-3 px-5 rounded-0 mb-lg-0 mb-2 d-block d-sm-inline-block">Shop Now</a>
                                <a href="#" class="btn btn-white py-3 px-5 rounded-0 d-block d-sm-inline-block">Club Membership</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="product" style="margin-top: 50px">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="left_sidebar_area">
                        <aside class="left_widgets cat_widgets">
                            <div class="l_w_title">
                                <h3>Browse Category</h3>
                            </div>
                            <div class="widgets_inner">
                                <ul class="list">
                                    <?php
                                    $i=0;
                                    ?>
                                    @foreach($cats as $cat)
                                        <li>
                                            <a href="{{route('categories.cat',$cat->id)}}">{{$cat->name}}</a>
                                            <ul class="list">


                                            </ul>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </aside>

                    </div>
                </div>
                <style>
                    .hover{
                        position: absolute;
                        top: 0;
                        left: 0;
                        display: none;
                        background-color: rgba(	203, 203, 203,0.5) ;/*//#cbcbcb;*/
                        /*//opacity: 0.5;*/
                        width: 100%;
                        height: 250px;
                        transition-timing-function: ease-in-out;
                        transition-delay: 0.5s;
                        cursor: pointer;
                    }
                    .hover a{
                        opacity: 1;
                        margin-left: 76px;
                        margin-top: 111px;
                    }
                    .asd{
                        position: relative;
                    }
                    .asd:hover .hover{
                        display: block;
                    }
                    .img{
                        width :100% ;
                        height: 100%;
                        transition: 1s ease-in-out ;
                    }
                    .ownIMG{
                        width: 100%;
                        height: 250px;
                    }
                    .price{
                        font-size: 19px;
                        color: #006fb3;
                        font-weight: bold;
                    }
                    .dis_price{
                        color: #D6D6D6;

                    }
                </style>
                <div class="col-lg-9" >
                    <h2 class="card-title">Best Deals </h2>

                    @foreach($cats as $cat)
                        <?php

                        $products = App\product::where(['category_id'=>$cat->id])->limit(3)->get();
                        ?>
                        @foreach($products as $product)
                            <div class="card asd" style="width: 17rem;float: left; height: 527px;">
                                <div class="ownIMG">
                                    <img  src="{{asset('product_images/'.$product->img)}}"
                                          class="card-img-top img" alt="...">
                                </div>
                                <div class="hover">
                                    <a href="{{route('product.show',$product->id)}}" class="btn btn-primary">Quike View </a>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><a class="icon-anchor" href="{{route('product.show',$product->id)}}">
                                            {{$product->name}}</a> </h5>
                                    <p class="card-text">A T-Shirt From {{$cat->name}}</p>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            @if($product->discounted_price == 0)
                                                <div class="price">{{$product->price}} USA</div>
                                            @else
                                                <div class="price">{{$product->discounted_price}} USA</div>
                                                <div class="dis_price"><del>{{$product->price}}</del> USA</div>
                                            @endif
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="star-rating clearMargin-v-large">
                                                <div class="stars">
                                                    {{--- Will Be Back To Change IT --}}
                                                    <?php
                                                        $count = $product->reviews->avg('rating');
                                                    ?>
                                                    @for($i=0;$i<$count;$i++)
                                                        <i class="fa fa-star" style="color: #fbd600"></i>
                                                    @endfor
                                                    @for($i=$count+1;$i<=5;$i++)
                                                        <i class="fa fa-star"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <a href="{{route('addToCart',$product->id)}}" class="btn btn-black rounded-0" style="width:100% ; "> Add To Cart</a>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>


@endsection
