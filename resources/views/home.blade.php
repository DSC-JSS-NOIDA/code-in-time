@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if(!empty($questions))
                        <table class="table">
                            <tr>
                                <th>Sr. No.</th>
                                <th>Question Title</th>
                                <th>Total Submissions</th>
                                <th>Max Score</th>
                                <th>Remaining Score</th>
                                <th>Accuracy</th>
                            </tr>
                            @foreach($questions as $question)
                                <tr>
                                    <td>{{$ques_counter++}}</td>
                                    <td><a href="{{URL::to('question/'.$question->id)}}">{{$question->title}}</a></td>
                                    <td>{{$question->attempted}}</td>
                                    <td>{{$question->max_score}}</td>
                                    <td>{{$question->current_score}}</td>
                                    @if($question->attempted==0)
                                        <td>0</td>
                                    @else
                                        <td>{{$question->correct_sub/$question->attempted}}</td>
                                    @endif
                                </tr>   
                            @endforeach
                        </table>
                    @else
                        <h1>Questions Brewing Up</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
