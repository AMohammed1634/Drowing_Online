@extends('masterView')

@section('body')

    <div class="site-section" id="products-section" style="margin-top: 100px;">
        <div class="container">
            <div class="row mb-5 justify-content-center">
                <div class="col-md-6 text-center">
                    <h3 class="section-sub-title">Popular Products</h3>
                    <h2 class="section-title mb-3">Our Products</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae nostrum natus excepturi fuga ullam accusantium vel ut eveniet aut consequatur laboriosam ipsam.</p>
                </div>
            </div>

            <nav class="navbar navbar-light" style="background-color: #e3f2fd; height: 60px;margin-bottom: 10px;
                        border-radius: 5px">
                <span class="navbar-text" style="">{{$products->links()}}</span>
            </nav>
            <div class="row">

                @foreach($products as $pro)
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="product-item">
                            <figure>
                                <img src="{{asset('/product_images/'.$pro->img)}}" alt="Image" class="img-fluid">
                            </figure>
                            <div class="px-4">
                                <?php
                                $count = $pro->reviews->avg('rating'); //
                                ?>
                                <h3><a href="{{route('product.show',$pro->id)}}">{{$pro->name}}</a></h3>
                                <div class="mb-3">
                                <span class="meta-icons mr-3"><a href="#" class="mr-2">
                                        <span class="icon-star text-warning"></span>
                                    </a> {{$count}}
                                </span>
                                    {{--Will BE BACK--}}
                                    <span class="meta-icons wishlist">
                                    <a href="#" class="mr-2"><span class="icon-heart"></span></a> 29</span>
                                </div>
                                <p class="mb-4">{{$pro->description}}</p>
                                <div>
                                    <a href="{{route('addToCart',$pro->id)}}" class="btn btn-black mr-1 rounded-0">Cart</a>
                                    <a href="{{route('product.show',$pro->id)}}" class="btn btn-black btn-outline-black ml-1 rounded-0">View</a>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
                {{-- endforeach--}}


            </div>
        </div>
    </div>

@endsection
