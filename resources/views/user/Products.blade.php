@extends('masterView')

@section('body')

    <div class="site-section" id="products-section" style="margin-top: 100px;">
        <div class="container">
            <div class="row mb-5 justify-content-center">
                <div class="col-md-6 text-center">
                    <h3 class="section-sub-title">Popular Products</h3>
                    <h2 class="section-title mb-3">Our Categories</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae nostrum natus excepturi fuga ullam accusantium vel ut eveniet aut consequatur laboriosam ipsam.</p>
                </div>
            </div>
            <div class="row">
                @foreach($cats as $cat)
                <div class="col-lg-4 col-md-6 mb-5">
                    <div class="product-item">
                        <figure>
                            <img src="{{asset('/product_images/'.$cat->product->first()->img)}}" alt="Image" class="img-fluid">
                        </figure>
                        <div class="px-4">
                            <?php
                            $count = $cat->product->last()->reviews->avg('rating'); //
                            ?>
                            <h3><a href="{{route('categories.cat',$cat->id)}}">{{$cat->name}}</a></h3>
                            <div class="mb-3">
                                <span class="meta-icons mr-3"><a href="#" class="mr-2">
                                        <span class="icon-star text-warning"></span>
                                    </a> {{$count}}</span>
                                {{--Will BE BACK--}}
                                <span class="meta-icons wishlist">
                                    <a href="#" class="mr-2"><span class="icon-heart"></span></a> 29</span>
                            </div>
                            <p class="mb-4">{{$cat->product->last()->description}}</p>
                            <div>
                                <a href="{{route('addToCart',$cat->product->last()->id)}}" class="btn btn-black mr-1 rounded-0">Cart</a>
                                <a href="{{route('product.show',$cat->product->last()->id)}}" class="btn btn-black btn-outline-black ml-1 rounded-0">View</a>
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
