@extends('_global.html')
@section('content')
    <h1>Hello {{ $title }} Blade Template 2</h1>
    <ul>
        @foreach($sakuras as $sakura)
            <li>{{$sakura}}</li>
        @endforeach
    </ul>
@stop