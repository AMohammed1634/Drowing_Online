@extends('admin.app')

@section('header')
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
@endsection

@section('body')
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{count($orders)}}</h3>

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
                <h3>{{count($users)}}</h3>

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
                <h3>{{count($admins)}}</h3>

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
<section class="content">
    <div class="row">
        <div class="col-md-8">
            {{----}}

            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Latest Orders</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Item</th>
                                <th>Status</th>
                                <th>Total Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{--work here--}}
                            @foreach($lastOreders as $order)
                            <tr>
                                <td><a href="{{route('dashboard.order',$order->id)}}">{{$order->shopping_id}}</a></td>
                                <td style="width: 250px;">
                                    <div class="box box-default collapsed-box">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">{{$order->shoppingCart[0]->product->category->name}}</h3>

                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                            <!-- /.box-tools -->
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body" style="display: none;">
                                            <ul>
                                                @foreach($order->shoppingCart as $cart)
                                                    <li><a href="{{route('product.show',$cart->product->id)}}"> {{$cart->product->name}}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </td>
                                <td><span class="label label-success">Sent</span></td>
                                <td>
                                    <div class="sparkbar" data-color="#00a65a" data-height="20">
                                            {{$order->total_amount}} USA
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            {{--work here--}}

                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">

                    <a href="{{route('dashboard.orders')}}" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                </div>
                <!-- /.box-footer -->
            </div>
            {{----}}
        </div>
        <div class="col-md-4">
            {{----}}
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Recently Added Products</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <ul class="products-list product-list-in-box">
                        @foreach($lastProduct as $product)
                        <li class="item">
                            <div class="product-img">
                                <img src="product_images/{{$product->img}}" alt="Product Image">
                            </div>
                            <div class="product-info">
                                <a href="{{route('product.show',$product->id)}}" class="product-title">{{$product->name}}
                                    <span class="label label-warning pull-right">${{$product->price}}</span></a>
                                <span class="product-description">
                          {{$product->description}}
                        </span>
                            </div>
                        </li>
                        <!-- /.item -->
                        @endforeach

                        <!-- /.item -->


                    </ul>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="{{route('product.index')}}" class="uppercase">View All Products</a>
                </div>
                <!-- /.box-footer -->
            </div>

            {{----}}
        </div>
    </div>
</section>
@endsection
