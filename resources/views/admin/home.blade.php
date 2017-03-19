@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Administrator</div>

                <div class="panel-body">
                    <table class="table">
                    <tr>
                        <th>Sr. No</th>
                        <th>Question Title</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>

                    @foreach($questions as $question)
                        <tr>
                            <td>{{$counter++}}</td>
                            <td>{{$question->title}}</td>
                            <td><a class="btn btn-primary" href="{{URL::to('/edit/'.$question->id)}}">Edit</a></td>
                            <td><a class="btn btn-danger" href="{{URL::to('/delete/'.$question->id)}}">Delete</a></td>
                        </tr>
                    @endforeach
                    
                    </table>
                </div>
            </div>
            <center><a class="btn btn-default" href="{{URL::to('/edit/new')}}">Create New Question</a></center>
        </div>
    </div>
</div>
@endsection
