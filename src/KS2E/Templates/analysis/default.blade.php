@extends('_global.master')
@section('page_title')
    Analysis | KS2E
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

    <script>
        {!! "var obj = ".json_encode($analysisData).";" !!}
        {!! "var ykeys = ".json_encode($ykeys).";" !!}

        Morris.Line({
            // ID of the element in which to draw the chart.
            element: 'my-line-chart',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data: obj,
            // The name of the data record attribute that contains x-values.
            xkey: 'DurationStartTime',
            xLabels: 'hour',
            // A list of names of data record attributes that contain y-values.
            ykeys: ykeys,
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ykeys,
            smooth: false,
            ymax: 100,
            //goals: [80.0, 60.0],
            //goalStrokeWidth: 2,
            //goalLineColors: ["yellow", "red"],
            resize: true
        });
    </script>
@stop

@section('sidebar')
    @foreach($objectList as $object)
        <li>
            @if($object['CurrentLevel'] != 'Device')
                <a href="analysis?queryTarget={{$object['NextLevel']}}&query{{$object['CurrentLevel']}}={{$object['ObjectId']}}">
                    <span>{{$object['ObjectName']}}<span class="text-warning"> (0)</span></span>
                    <span class="pull-right"><span class="text-success">{{$object['HealthRate']}}%</span></span>
                </a>
            @else
                <a href="analysis?queryTarget=Device&queryDeviceManager={{$object['DeviceManagerId']}}">
                    <span>{{$object['ObjectName']}}<span class="text-warning"> (0)</span></span>
                    <span class="pull-right"><span class="text-success">{{$object['HealthRate']}}%</span></span>
                </a>
            @endif

        </li>
    @endforeach
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h3>
                <a>Global</a>
                &gt;
                <a>Global</a>
                &gt;
                <span>Global</span>
            </h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Trend
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="my-line-chart" style="height:200px;"></div>
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
                    Error Log
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div><span>NVR</span> - <span>Offline</span><span class="pull-right">20 mins</span></div>

                                    <div><span>Taipei 101 - Parking Lot (B3)</span><span class="pull-right">2016/07/23 14:10</span></div>
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div><span>NVR</span> - <span>Offline</span><span class="pull-right">20 mins</span></div>

                                    <div><span>Taipei 101 - Parking Lot (B3)</span><span class="pull-right">2016/07/23 14:10</span></div>
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div><span>NVR</span> - <span>Offline</span><span class="pull-right">20 mins</span></div>

                                    <div><span>Taipei 101 - Parking Lot (B3)</span><span class="pull-right">2016/07/23 14:10</span></div>
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div><span>NVR</span> - <span>Offline</span><span class="pull-right">20 mins</span></div>

                                    <div><span>Taipei 101 - Parking Lot (B3)</span><span class="pull-right">2016/07/23 14:10</span></div>
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
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