@extends('admin.app')
@section('header')
    <h1>
        Order
        <small>{{$order->shopping_id}}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{route('dashboard.orders')}}">Orders</a></li>
        <li class="active">{{$order->shopping_id}}</li>
    </ol>
@endsection

@section('body')
<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-globe"></i> <img src="{{asset('tshirtshop.png')}}">, Inc.
                <small class="pull-right">Date:{{$order->created_at}}</small>
            </h2>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            From
            <address>
                <strong>TSirtShop, Inc.</strong><br>
                795 Folsom Ave, Suite 600 ( will change)<br>
                San Francisco, CA 94107 ( will change)<br>
                Phone: (804) 123-5432 ( will change)<br>
                Email: info@almasaeedstudio.com  ( will change)
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            To
            <address>
                <strong>{{$order->user->name}}</strong><br>
                795 Folsom Ave, Suite 600 ( will change)<br>
                San Francisco, CA 94107 ( will change)<br>
                Phone: (555) 539-1037 ( will change)<br>
                Email: {{$order->user->email}}
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <b>Order {{$order->id}}</b><br>
            <br>
            <b>Order ID:</b> {{$order->shopping_id}}<br>
            <b>Payment Due:</b> {{$order->created_at}}<br>

        </div>
        <!-- /.col -->
    </div>
    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Qty</th>
                    <th>Product</th>
                    <th>Serial #</th>
                    <th>Description</th>
                    <th>Subtotal</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $total = 0;
                $descount = 0;
                ?>
                @foreach($order->shoppingCart as $cart)
                <tr>
                    <td>{{$cart->quantity}}</td>
                    <td>{{$cart->product->name}}</td>
                    <td>455-981-221</td>
                    <td style="max-width: 300px;">{{$cart->product->description}}</td>
                    <td>
                        @if($cart->product->discounted_price == 0)
                            <?php
                            $total += $cart->product->price * $cart->quantity;
                            $descount += $cart->product->price * $cart->quantity;
                            ?>
                            {{$cart->product->price * $cart->quantity}} USA
                        @else
                            <?php
                            $total += $cart->product->price * $cart->quantity;
                            $descount += $cart->product->discounted_price * $cart->quantity;
                            ?>
                            {{$cart->product->discounted_price * $cart->quantity}} USA
                        @endif
                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">

        <div class="col-xs-6">
            <p class="lead">Amount Due {{$order->created_at}}</p>

            <div class="table-responsive">
                <table class="table">
                    <tbody><tr>
                        <th style="width:50%">Total:</th>
                        <td>{{$total}} USA</td>
                    </tr>
                    <tr>
                        <th>Discount ({{($total - $descount)/$total * 100}}9.3%)</th>
                        <td>{{$total - $descount}} USA</td>
                    </tr>

                    <tr>
                        <th>Total After Discount:</th>
                        <td>
                            @if($descount == 0)
                                {{$total}}
                            @else
                                {{$descount}} USA
                            @endif
                        </td>
                    </tr>
                    </tbody></table>
            </div>
        </div>

    </div>
</section>

@endsection
