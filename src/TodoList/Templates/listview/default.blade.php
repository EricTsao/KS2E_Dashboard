@extends('_global.html')
@section('page_title')
    {{ $name }}'s Todo List
@stop
@section('content')
    <div class="container">
        <h1>{{ $name }}'s Todo List</h1>
        <div>
            <!-- Button trigger modal -->
            <a class="btn btn-primary btn-lg" role="button" data-toggle="modal" data-target="#myModal">Add Task</a>
        </div>
        <!-- row of columns -->
        <div class="row">
            @foreach($todoItems as $item)
                <div class="col-md-4">
                    <h2>{{$item[2]}}</h2>
                    <form action="listview?_method=DELETE" method="post">
                        <input type="hidden" name="RecordId" value="{{$item[0]}}"/>
                        <button type="submit" class="btn btn-default">Delete &raquo;</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div> <!-- /container -->

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="listview" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Task</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="task">Task:</label>
                            <textarea type="text" class="form-control" id="task" rows="5" name="task"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop