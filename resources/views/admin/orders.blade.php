@extends('admin.app')

@section('header')
    <h1>
        All Orders
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{route('dashboard.orders')}}">Orders</a></li>

    </ol>
@endsection

@section('body')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                {{----}}

                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">All Orders</h3>

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
                                @foreach($orders as $order)
                                    <tr>
                                        <td><a href="{{route('dashboard.order',$order->id)}}">{{$order->shopping_id}}</a></td>
                                        <td style="width: 250px;">


                                            <div class="box box-warning collapsed-box">
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

        </div>
    </section>
@endsection


