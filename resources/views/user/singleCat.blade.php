@extends('masterView')

@section('body')
    <div class="product" style="margin-top: 200px;">
        <div class="container">
            <h2 class="title " style="text-align: center">{{$products[0]->category->name}} Products </h2>
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
                                            @if($cat->id == $products[0]->category_id)
                                            <a href="{{route('categories.cat',$cat->id)}}" class=""
                                             style="color:#0d95e8" >{{$cat->name}}</a>
                                            @else
                                                <a href="{{route('categories.cat',$cat->id)}}" class="link">{{$cat->name}}</a>
                                            @endif
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
                    .myNav{
                        height: 60px;
                        background-color: ;
                    }
                </style>
                <div class="col-lg-9" >
                    <nav class="navbar navbar-light" style="background-color: #e3f2fd; height: 60px;margin-bottom: 10px;
                        border-radius: 5px">
                        <span class="navbar-text" style="">{{$products->links()}}</span>
                    </nav>


                    @foreach($products as $product)


                            <div class="card asd" style="width: 33.33%;float: left; height: 527px;">
                                <div class="ownIMG">
                                    <img  src="/product_images/{{$product->img}}"
                                          class="card-img-top img" alt="...">
                                </div>
                                <div class="hover">
                                    <a href="{{route('product.show',$product->id)}}" class="btn btn-primary">Quike View </a>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><a class="icon-anchor" href="{{route('product.show',$product->id)}}">
                                            {{$product->name}}</a> </h5>
                                    <p class="card-text">A T-Shirt From {{$product->name}}</p>
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
                                                    {{--- Changed --}}
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
                                    <a href="{{route('addToCart',$product->id)}}" class="btn btn-primary" style="width:100% ; "> Add To Cart</a>
                                </div>
                            </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
