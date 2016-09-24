@extends('_global.master')
@section('page_title')
    Dashboard | KS2E
@stop

@section('meta')
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
@stop

@section('style')
    <!-- Timeline CSS -->
    <link href="{{ $uri->path }}/asset/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ $uri->path }}/asset/dist/css/sb-admin-2.css" rel="stylesheet">
@stop

@section('script')
    <!-- Custom Theme JavaScript -->
    <script src="{{ $uri->path }}/asset/dist/js/sb-admin-2.js"></script>
@stop

@section('sidebar')
    @foreach($objectList as $object)
        <li>
            <a href="dashboard?&query{{$object['CurrentLevel']}}={{$object['ObjectId']}}">
                <span>{{$object['ObjectName']}}<span class="text-warning"> (0)</span></span>
                <span class="pull-right"><span class="text-success">{{$object['HealthRate']}}%</span></span>
            </a>
        </li>
    @endforeach
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h3>
                <a href="dashboard">Global</a>
                @if($currentObjectId != '')
                    &gt; <span>{{$currentObjectName}}</span>
                @endif
            </h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Alert<span class="text-danger"> ({{count($dashboardAlertItemList)}})</span>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        @foreach($dashboardAlertItemList as $dashboardItem)
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-primary">
                                    <div class="panel-body">
                                        <div>{{$dashboardItem['DeviceManager']}}</div>
                                        <div class="text-center"><h1 class="text-danger">{{$dashboardItem['HealthRate']}}%</h1></div>
                                        <div><span class="pull-right">{{$dashboardItem['Account']}}</span></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    List<span class="text-success"> ({{count($dashboardNormalItemList)}})</span>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        @foreach($dashboardNormalItemList as $dashboardItem)
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-primary">
                                    <div class="panel-body">
                                        <div>{{$dashboardItem['DeviceManager']}}</div>
                                        <div class="text-center"><h1 class="text-success">{{$dashboardItem['HealthRate']}}%</h1></div>
                                        <div><span class="pull-right">{{$dashboardItem['Account']}}</span></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
    <!-- /.row -->
@stop