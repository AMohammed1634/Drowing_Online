<!-- main css -->
<meta name="csrf-token" content="{{ csrf_token() }}">
@extends('masterView')

@section('body')
    <style>
        .asd-product-item{
            cursor: pointer;
        }
        .price{
            font-size: 19px;
            color: #006fb3;
            font-weight: bold;
        }
        .dis_price{
            color: #D6D6D6;

        }
        .img{
            width: 50%;
            height: 80px;
            margin: 15px;
        }
        .img img{
            width: 100%;
            height: 100%;
        }
        .img img:hover{
            border: 2px solid #c57906;
        }
    </style>
    <div class="product" style="margin-top: 150px">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="row img">
                        <img  src="{{asset('product_images/'.$product->img)}}" id="img1">
                    </div>
                    <div class="row img">
                        <img  src="{{asset('product_images/'.$product->img_2)}}" id="img2">
                    </div>
                    <div class="row img">
                        <img  src="{{asset('product_images/'.$product->thumbnail)}}"  id="img3">
                    </div>
                </div>
                <div class="col-lg-4 product-item asd-product-item">
                    <figure>
                    <img src="{{asset('product_images/'.$product->img)}}" style="width: 90%;height: 300px;margin: auto;
                                " class="img-fluid" id="img">
                    </figure>
                </div>
                <div class="col-lg-6">
                    <h2 class="product-title-wrap">
                        {{$product->name}}
                    </h2>
                    @if($product->discounted_price == 0)
                        <div class="price">Price: {{$product->price}} USA</div>
                    @else
                        <div class="price">Price: {{$product->discounted_price}} USA</div>
                        <div class="dis_price"><del>Price: {{$product->price}}</del> USA</div>
                    @endif
                    <hr class="line-height-1">
                    <div class="align-content-around" style="margin-top: 75px">
                        {{$product->description}}
                    </div>
                    <br><br>
                    <a href="{{route('addToCart',$product->id)}}" class="btn btn-outline-primary">Add To Cart</a>
                </div>
            </div>
            {{--Second Row Of Reviews --}}
            <div class="row">

            </div>
        </div>
    </div>
<script>
    document.getElementById('img1').onclick = function () {
        document.getElementById('img').src = "{{asset('product_images/'.$product->img)}}";
    }
    document.getElementById('img2').onclick = function () {
        document.getElementById('img').src = "{{asset('product_images/'.$product->img_2)}}";
    }
    document.getElementById('img3').onclick = function () {
        document.getElementById('img').src = "{{asset('product_images/'.$product->thumbnail)}}";
    }
</script>


    <!--================Product Description Area =================-->
    <section class="product_description_area">
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">

                <li class="nav-item">
                    <a class="nav-link active" id="review-tab" data-toggle="tab" href="#review"
                       role="tab" aria-controls="review" aria-selected="false">Reviews</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row total_rate">
                                <div class="col-6">
                                    <div class="box_total">
                                        <h5>Overall</h5>
                                        <?php
                                        $avg = App\review::where(['product_id'=>$product->id])->avg('rating');
                                        $count = App\review::where(['product_id'=>$product->id])->count();
                                        ?>
                                        <h4>{{$avg}}</h4>
                                        <h6>({{$count}} Reviews)</h6>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="rating_list">
                                        <h3>Based on {{$count}} Reviews</h3>
                                        <ul class="list">
                                            @foreach($product->reviews->unique('rating') as $review) {{--  --}}
                                                <li>
                                                    <?php
                                                    $count = App\review::where(['product_id'=>$product->id ,
                                                                                'rating'=>$review->rating])->count();
                                                    ?>
                                                    <a href="#">
                                                        {{$review->rating}} Star
                                                        @for($i=1;$i<=$review->rating;$i++)
                                                            <i class="fa fa-star"></i>
                                                        @endfor
                                                        @for($i=$review->rating+1;$i<=5;$i++)
                                                            <i class="fa fa-star" style="color: #D6D6D6"></i>
                                                        @endfor  {{ $count}} Users
                                                    </a>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="review_list">


                                @foreach($product->reviews as $review)
                                    <div class="review_item">
                                        <div class="media">
                                            <div class="d-flex" style="">
                                                @if(is_null($review->user->img))
                                                    <span class="icon-user-circle" style="font-size: 50px; color: darkgrey;">

                                                    </span>
                                                @else
                                                    <img style="width: 93px;height: 93px;border-radius: 50%;"
                                                         src="/storage/profile_images/{{$review->user->img}}" alt="">
                                                @endif
                                            </div>
                                            <div class="media-body">
                                                <h4>{{$review->user->name}}</h4>
                                                @for($i=1;$i<=$review->rating;$i++)
                                                    <i class="fa fa-star"></i>
                                                @endfor
                                                @for($i=$review->rating+1;$i<=5;$i++)
                                                    <i class="fa fa-star" style="color: #D6D6D6"></i>
                                                @endfor

                                            </div>
                                        </div>
                                        <p>{!! $review->review !!}</p>
                                        <div>{{$review->created_at}}</div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="review_box">
                                <h4>Add a Review</h4>
                                <p>Your Rating:</p>
                                <ul class="list">
                                    <li>
                                        <a id="star1" onclick="star1_call">
                                            <i class="fa fa-star"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a  id="star2">
                                            <i class="fa fa-star"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a id="star3">
                                            <i class="fa fa-star"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a id="star4">
                                            <i class="fa fa-star"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a  id="star5">
                                            <i class="fa fa-star"></i>
                                        </a>
                                    </li>
                                </ul>
                                <script>
                                    var s1= document.getElementById('star1');
                                    var s2= document.getElementById('star2');
                                    var s3= document.getElementById('star3');
                                    var s4= document.getElementById('star4');
                                    var s5= document.getElementById('star5');
                                    s1.onmouseover = function(){
                                        s1.style.color = "#fbd600";
                                        s2.style.color = s3.style.color = s4.style.color = s5.style.color =
                                            "#DDD";
                                    }
                                    s1.onmouseleave = function () {
                                        s1.style.color = "#fbd600";
                                        s2.style.color = "#fbd600";
                                        s3.style.color = "#fbd600";
                                        s4.style.color = "#fbd600";
                                        s5.style.color = "#fbd600";
                                    }
                                    s2.onmouseover = function(){
                                        s2.style.color = "#fbd600";
                                        s1.style.color = "#fbd600";
                                        s3.style.color = s4.style.color = s5.style.color =
                                            "#DDD";
                                    }
                                    s2.onmouseleave = function () {

                                        s1.style.color = "#fbd600";
                                        s2.style.color = "#fbd600";
                                        s3.style.color = "#fbd600";
                                        s4.style.color = "#fbd600";
                                        s5.style.color = "#fbd600";
                                    }
                                    s3.onmouseover = function(){
                                        s2.style.color = "#fbd600";
                                        s1.style.color = "#fbd600";
                                        s3.style.color = "#fbd600";
                                        s4.style.color = s5.style.color =
                                            "#DDD";
                                    }
                                    s3.onmouseleave = function () {
                                        s1.style.color = "#fbd600";
                                        s2.style.color = "#fbd600";
                                        s3.style.color = "#fbd600";
                                        s4.style.color = "#fbd600";
                                        s5.style.color = "#fbd600";
                                    }
                                    s4.onmouseover = function(){
                                        s2.style.color = "#fbd600";
                                        s1.style.color = "#fbd600";
                                        s3.style.color = "#fbd600";
                                        s4.style.color = "#fbd600";
                                        s5.style.color =
                                            "#DDD";
                                    }
                                    s4.onmouseleave = function () {
                                        s1.style.color = "#fbd600";
                                        s2.style.color = "#fbd600";
                                        s3.style.color = "#fbd600";
                                        s4.style.color = "#fbd600";
                                        s5.style.color = "#fbd600";
                                    }
                                    //var inp = document.getElementById('rating');
                                    document.getElementById('star1').onclick = function  () {
                                        document.getElementById('rating').value = "1";

                                        document.getElementById('star1').style.color = "#fbd600";
                                        document.getElementById('star2').style.color = "#DDD";
                                        document.getElementById('star3').style.color = "#DDD";
                                        document.getElementById('star4').style.color = "#DDD";
                                        document.getElementById('star5').style.color = "#DDD";
                                        document.getElementById('star1').onmouseleave = function () {}
                                        //alert("asd");
                                    }

                                    document.getElementById('star2').onclick = function  () {
                                        document.getElementById('rating').value = "2";
                                        document.getElementById('star1').style.color = "#fbd600";
                                        document.getElementById('star2').style.color = "#fbd600";
                                        document.getElementById('star3').style.color = "#DDD";
                                        document.getElementById('star4').style.color = "#DDD";
                                        document.getElementById('star5').style.color = "#DDD";
                                        document.getElementById('star2').onmouseleave = function () {}

                                        //alert("asd");
                                    }
                                    document.getElementById('star3').onclick = function  () {
                                        document.getElementById('rating').value = "3";
                                        document.getElementById('star1').style.color = "#fbd600";
                                        document.getElementById('star2').style.color = "#fbd600";
                                        document.getElementById('star3').style.color = "#fbd600";
                                        document.getElementById('star4').style.color = "#DDD";
                                        document.getElementById('star5').style.color = "#DDD";
                                        document.getElementById('star3').onmouseleave = function () {}
                                        //alert("asd");
                                    }
                                    document.getElementById('star4').onclick = function  () {
                                        document.getElementById('rating').value = "4";
                                        document.getElementById('star1').style.color = "#fbd600";
                                        document.getElementById('star2').style.color = "#fbd600";
                                        document.getElementById('star3').style.color = "#fbd600";
                                        document.getElementById('star4').style.color = "#fbd600";
                                        document.getElementById('star5').style.color = "#DDD";
                                        document.getElementById('star4').onmouseleave = function () {}

                                        //alert("asd");
                                    }
                                    document.getElementById('star5').onclick = function  () {
                                        document.getElementById('rating').value = "5";
                                        document.getElementById('star1').style.color = "#fbd600";
                                        document.getElementById('star2').style.color = "#fbd600";
                                        document.getElementById('star3').style.color = "#fbd600";
                                        document.getElementById('star4').style.color = "#fbd600";
                                        document.getElementById('star5').style.color = "#fbd600";
                                        document.getElementById('star5').onmouseleave = function () {}

                                        //alert("asd");
                                    }
                                </script>
                                <p>Outstanding</p>
                                <form class="row contact_form" action="{{route('review.create',$product->id)}}" method="post" id="contactForm" novalidate="novalidate">
                                    {{csrf_field()}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <!--<input type="text" class="form-control" id="name" name="rating" placeholder="Your Rating Of Love ">-->
                                            <input type="hidden" class="form-control" id="rating" name="rating" value="5">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="form-control" name="review" id="summary-ckeditor" rows="1"
                                                      placeholder="Review"></textarea>
                                            <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
                                            <script>
                                                CKEDITOR.replace( 'summary-ckeditor' );
                                            </script>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <button type="submit"  class="btn submit_btn">Submit Now</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Product Description Area =================-->
@endsection
