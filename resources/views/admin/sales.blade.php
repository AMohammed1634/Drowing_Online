@extends('admin.app')
@section('header')
    <h1>
        All Product Sales
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{route('dashboard.sales')}}">SAles</a></li>

    </ol>
@endsection

@section('body')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{($orders)}}</h3>

                    <p>All Orders</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{route('dashboard.orders')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{( count($carts))/App\product::all()->count() * 100}}<sup style="font-size: 20px">%</sup></h3>

                    <p>Sales</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-cart-outline"></i>
                </div>
                <a href="{{route('dashboard.sales')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{($users)}}</h3>

                    <p>User Registrations</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{route('dashboard.registration')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{($admins)}}</h3>

                    <p>Admins</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{route('dashboard.admin')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <section class="carts">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Sales Products</h3>

                        <div class="box-tools">
                            <style>
                                .pagination{

                                    margin: 0 !important;
                                    float: right!important;
                                    padding:.25rem .5rem;font-size:0.9875rem;line-height:1.5;
                                    font-size: 75%;
                                    border-top-left-radius:.2rem;border-bottom-left-radius:.2rem;
                                    border-top-right-radius:.2rem;border-bottom-right-radius:.2rem;
                                }
                            </style>

                                {{$carts->links()}}

                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table">
                            <tbody><tr>
                                <th style="width: 10px">#</th>
                                <th>Name</th>
                                <th>IMAGE</th>
                                <th>Buy By </th>
                                <th style="width: 40px">QTY</th>
                                <th>Order ID</th>
                                <th>Time</th>
                            </tr>
                            @foreach($carts as $cart)
                                <tr>
                                    <td>{{$cart->id}}.</td>
                                    <td>{{$cart->product->name}}</td>
                                    <td>
                                        <img src="{{asset('product_images/'.$cart->product->img)}}" style="width:100px;height: 100px">
                                    </td>
                                    <td>
                                        <a class="" href="{{route('dashboard.userProfile',$cart->user->id)}}">{{$cart->user->name}}</a>
                                    </td>
                                    <td><span class="badge bg-red">{{$cart->quantity}} Item(S)</span></td>
                                    <td><a href="{{route('dashboard.order',$cart->order->id)}}">{{$cart->order->shopping_id}}</a> </td>
                                    <td>{{$cart->created_at}}</td>
                                </tr>
                            @endforeach

                            </tbody></table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
@endsection
