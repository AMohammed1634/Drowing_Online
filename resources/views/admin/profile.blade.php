@extends('admin.app')
@section('header')
    <h1>
        {{$user->name}} Profile
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('dashboard.registration')}}">Users Registeration </a></li>
        <li class="active">{{$user->name}} profile</li>
    </ol>
@endsection

@section('body')
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">

                    <img style="height: 100px" class="profile-user-img img-responsive img-circle"
                         src="@if(!is_null($user->img))
                                    {{asset('storage/profile_images/'.$user->img)}}
                             @else
                                    {{asset('storage/profile_images/noImage.jpg')}}
                             @endif
                             " alt="User profile picture">



                    <h3 class="profile-username text-center">{{$user->name}}</h3>

                    <p class="text-muted text-center">Software Engineer</p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Orders</b> <a class="pull-right">{{count($user->orders)}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Shopping Carts</b> <a class="pull-right">{{($user->shoppingCart->count())}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Wish List</b> <a class="pull-right">Will be back</a>
                        </li>
                    </ul>

                </div>

                <!-- /.box-body -->

            </div>
            <!-- /.box -->
            @if(!is_null($user->user_info))
            <div class="box box-primary" style="">
                <div class="box-header with-border">
                    <h3 class="box-title">About Me</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

                    <p class="text-muted">
                        B.S. in Computer Science from the University of Tennessee at Knoxville
                    </p>

                    <hr>

                    <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

                    <p class="text-muted">{{$user->user_info->city}}, {{$user->user_info->area}} , {{$user->user_info->street_name}}</p>


                    <hr>

                    <strong><i class="fa fa-phone margin-r-5"></i> Phone</strong>

                    <p>{{$user->user_info->phone}}.</p>
                </div>

                <!-- /.box-body -->
            </div>
            @endif
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active" id="1"><a href="#activity" data-toggle="tab">Orders</a></li>
                    <li class="" id="2"><a href="#timeline" data-toggle="tab">Shopping Carts</a></li>
                    <li class="" id="3"><a href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
                <script>
                    document.getElementById('2').onclick = function () {
                        document.getElementById('1').className = "";
                        document.getElementById('3').className = "";
                        document.getElementById('2').className = "active";
                    }
                    document.getElementById('1').onclick = function () {
                        document.getElementById('2').className = "";
                        document.getElementById('3').className = "";
                        document.getElementById('1').className = "active";
                    }
                    document.getElementById('3').onclick = function () {
                        document.getElementById('2').className = "";
                        document.getElementById('1').className = "";
                        document.getElementById('3').className = "active";
                    }
                </script>
                <div class="tab-content">
                    {{--Orders--}}
                    <div class="active tab-pane" id="activity">
                        <!-- Post -->
                        <div class="row">
                            <div class="col-md-12">


                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">{{$user->name}} Orders</h3>

                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body" style="">
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
                                                @foreach($user->orders as $order)
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
                                    <div class="box-footer clearfix" style="">

                                        <a href="http://127.0.0.1:8000/dashboard/orders" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                                    </div>
                                    <!-- /.box-footer -->
                                </div>

                            </div>

                        </div>
                        <!-- /.post -->

                    </div>
                    <!-- /.tab-pane -->
                    {{--ShoppingCart--}}
                    <div class="tab-pane" id="timeline">
                        <!-- The timeline -->
                        <ul class="timeline timeline-inverse">
                            <!-- timeline time label -->
                            @foreach($user->orders as $order)
                                @foreach($order->shoppingCart as $cart)
                            <li class="time-label">
                                <span class="bg-red">
                                  {{$cart->created_at}}

                                </span>
                            </li>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-envelope bg-blue"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                    <?php

                                    ?>
                                    <h3 class="timeline-header"><a href="{{route('product.show',$cart->product->id)}}">
                                            {{$cart->product->name}}</a> </h3>

                                    <div class="timeline-body">
                                        <div class="row">
                                            <div class="col-md-4">

                                                <img src="{{asset('product_images/'.$cart->product->img)}}">
                                            </div>
                                            <div class="col-md-8">
                                                {{$cart->product->description}}
                                            </div>
                                        </div>

                                    </div>
                                    <div class="timeline-footer">
                                        <a class="btn btn-primary btn-xs" href="{{route('product.show',$cart->product->id)}}">Read more</a>
                                        <a class="btn btn-danger btn-xs">Delete <small>Well back</small></a>
                                    </div>
                                </div>
                            </li>
                            <!-- END timeline item -->
                                @endforeach
                            @endforeach



                        </ul>
                    </div>
                    <!-- /.tab-pane -->
                    {{--Orders--}}
                    <div class="tab-pane" id="settings">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">Name</label>

                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputName" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">Name</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                                <div class="col-sm-10">
                                    <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>


@endsection
