@extends('admin.app')

@section('header')
    <h1>
        Users Registeration
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{route('dashboard.registration')}}">Rigestration </a></li>

    </ol>
@endsection

@section('body')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
                        @if(isset($name))
                            Result Of {{$name}}
                        @else
                            Users Registeration
                        @endif
                    </h3>

                    <style>
                        .pagination{
                            margin: 0px;
                        }
                    </style>
                    <div class="box-tools" style="margin-right: 200px">
                        @if(!isset($name))
                            {{$users->links()}}
                        @endif
                    </div>
                    <div class="box-tools">
                        <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                            <form action="{{route('searchUser')}}"  method="post" id="search" style="">
                                @csrf
                                <input type="text" name="name" id="name" class="form-control pull-right" placeholder="Search"
                                 style="width: 74%;" value="@if(isset($name)){{$name}}@endif">

                                <div class="input-group-btn">
                                    <button type="submit" id="btn"  class="btn btn-default" style="
                                    border-top-right-radius: 0;
                                    border-bottom-right-radius: 0;
                                    border-top-left-radius: 3px;
                                    border-bottom-left-radius: 3px;"
                                    ><i class="fa fa-search"></i></button>
                                </div>
                                <?php
                                $u = null;
                                //echo ;
                                ?>
                                <script>
                                    /*
                                    document.getElementById('search').onsubmit = function (event) {
                                        event.preventDefault();
                                        var xhttp;
                                        xhttp = new XMLHttpRequest();
                                        xhttp.onreadystatechange = function() {
                                            if (this.readyState == 4 && this.status == 200) {
                                                console.log(JSON.parse(this.responseText));
                                                <?php $u = 'JSON.parse(this.responseText)' ?> ;
                                                console.log(<?php echo $u?>);

                                            }
                                        };
                                        xhttp.open("GET",
                                            "http://127.0.0.1:8000/dashboard/search/"+document.getElementById('name').value, true);

                                        xhttp.send();
                                        */
                                    }
                                </script>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody><tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>E-Mail</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Profile Image</th>
                            <th>chance</th>
                        </tr>
                        {{isset($_POST['btn'])}}
                        <?php
                        $i = -1;
                        ?>
                        @if(!isset($_POST['btn']))
                        @foreach($users as $user)
                            <?php
                            $i++;
                            ?>
                        <tr>
                            <td>{{$user->id}}</td>
                            <td><a href="{{route('dashboard.userProfile',$user->id)}}">{{$user->name}}</a></td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at}}</td>
                            @if($user->role_id == 3)
                                <td><span class="label label-warning">Admin Super </span></td>
                            @else
                                <td><span class="label label-success">Normal User</span></td>
                            @endif

                            <td>
                                @if(is_null($user->img))
                                    No Image
                                @else
                                    <a  data-toggle="modal" data-target="#modal-danger{{$i}}" href="{{asset('storage/profile_images/'.$user->img)}}">{{$user->img}}</a>
                                    <div class="modal fade in" id="modal-danger{{$i}}" style="display: none; opacity: 1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span></button>
                                                    <h4 class="modal-title">{{$user->name}}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="{{asset('storage/profile_images/'.$user->img)}}" style="width: 100%;height: 450px;">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                @endif
                            </td>
                            <td>
                                <form action="/dashboard/registration/update/{{$user->id}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    @if($user->role_id == 3)
                                        <button type="submit" name="update" value="1" class="btn btn-danger">Down Power</button>
                                    @else
                                        <button type="submit" name="update" value="3" class="btn btn-success">Up Power</button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @endif


                        </tbody></table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
@endsection





