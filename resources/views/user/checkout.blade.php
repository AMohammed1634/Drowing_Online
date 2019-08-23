@extends('masterView')
@section('body')
    <link rel="stylesheet" href="/css/app.css">
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
    <div class="" style="margin-top: 150px;margin-bottom: 100px">
        <div class="container">
            <div class="row" >
                <div class="col-lg-8">
                    {{--Form User Compleate data--}}
                    <!-- Default form register -->
                        <form class="text-center border border-light p-5 card" id="form"
                              action="{{route('makeOrder')}}" method="post">
                            @if($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Solve This Errors!</strong>
                                    <ul>

                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                            @endif
                            @csrf
                            <p class="h4 mb-4">Add New Address</p>

                            <div class="form-row mb-4">
                                <div class="col">
                                    <!-- First name -->
                                    <input type="text" id="" class="form-control" placeholder="First name" value="{{auth()->user()->name}}">
                                </div>
                                <div class="col">
                                    <!-- Last name -->
                                    <input type="text" id="lastName" name="lastName" class="form-control" placeholder="Last name">
                                </div>
                            </div>

                            <div class="form-row mb-4">
                                <div class="col">
                                    <!-- City -->
                                    <input type="text" id="city" name="city" class="form-control" placeholder="City">
                                </div>
                                <div class="col">
                                    <!-- Area -->
                                    <input type="text" id="area" name="area" class="form-control" placeholder="Area">
                                </div>
                            </div>
                            <!-- E-mail -->
                            <input type="text" id="street" name="street" class="form-control mb-4" placeholder="Street Name/No.	*">




                            <!-- Phone number -->
                            <input type="number" id="phone" class="form-control mb-4" name="phone" placeholder="Phone number" >

                            <!-- Sign up button -->
                            <button class="btn btn-info my-4 btn-block" type="submit">Oreder Now </button>

                            <script>
                                document.getElementById('form').onsubmit = function (event) {
                                    event.preventDefault();
                                    var error = true;
                                    if(document.getElementById('lastName').value.length<=3){
                                        document.getElementById('lastName').style.borderColor = "#F00";
                                        error = false;
                                    }else{
                                        document.getElementById('lastName').style.borderColor = "#ced4da";
                                    }
                                    if(document.getElementById('city').value.length<=0){
                                        document.getElementById('city').style.borderColor = "#F00";
                                        error = false;
                                    }else{
                                        document.getElementById('city').style.borderColor = "#ced4da";
                                    }
                                    if(document.getElementById('area').value.length<=0){
                                        document.getElementById('area').style.borderColor = "#F00";
                                        error = false;
                                    }else{
                                        document.getElementById('area').style.borderColor = "#ced4da";
                                    }

                                    if(document.getElementById('street').value.length<=0){
                                        document.getElementById('street').style.borderColor = "#F00";
                                        error = false;
                                    }else{
                                        document.getElementById('street').style.borderColor = "#ced4da";
                                    }

                                    if(document.getElementById('phone').value.length<=0){
                                        document.getElementById('phone').style.borderColor = "#F00";
                                        error = false;
                                    }else{
                                        document.getElementById('phone').style.borderColor = "#ced4da";
                                    }
                                    if(error)
                                        document.getElementById('form').submit();
                                }
                            </script>


                        </form>
                        <!-- Default form register -->

                    {{-- End Form--}}
                </div>

                <div class="col-lg-4">
                    <h2 class="card-title">
                        <div class="row">
                            <div class="col-lg-8">Shopping Card</div>
                            <div class="col-lg-4" style="font-size: 15px"><a href="{{route('shopping_cart')}}">Back To Cart</a> </div>
                        </div>
                    </h2>
                    {{--End Card --}}
                    <div  style="height: 250px;overflow: auto">
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
                                            <div class="col-12">
                                                <p class="card-text">
                                                @if($cart->product->discounted_price == 0)
                                                    <div class="price">{{$cart->product->price}} USA</div>
                                                @else
                                                    <div class="price">{{$cart->product->discounted_price}} USA</div>
                                                    <div class="dis_price"><del>{{$cart->product->price}}</del> USA</div>
                                                @endif
                                                </p>
                                            </div>
                                            QTY:{{$cart->quantity}}
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    @endforeach
                    {{--End Card --}}
                    </div>
                    <div class="" style="width: 100%;background-color: #fafafa;padding: 10px 15px">
                        <div class="row" style="font-size: 15px">
                            <div class="col-lg-8">
                                Item(s)
                            </div>
                            <div class="col-lg-4">
                                {{$total}} USA
                            </div>
                        </div>
                    </div>
                    <div style="width: 100%;background-color: #eeeeee;padding: 15px;">
                        <div class="row" style="font-size: 20px">
                            <div class="col-lg-6">
                                Grand Total
                            </div>
                            <div class="col-lg-6">
                                {{$total}} USA
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
