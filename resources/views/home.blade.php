@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7">
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

        <div class="col-md-5 ">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Submissions</h2></div>

                <div class="panel-body">
                     <table class="table">
                    <tr>
                        <th>Sr. No.</th>
                        <th>Name </th>
                        <th>Result</th>
                        <th>Marks</th>
                        <th>Question</th>
                        <th>Time</th>
                    </tr>
                    <?php $i=($submissions->currentPage()>1)?($submissions->currentPage()-1)*5+1:1;?>
                    @if(count($submissions))
                        @foreach($submissions as $submission)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$submission->name}}</td>
                                <td>@if($submission->status) <i>CA</i>@else <i>WA</i>@endif</td>
                                <td>{{$submission->marks}}</td>
                                <td>{{$submission->title}}</td>
                                <td>{{\Carbon\Carbon::parse($submission->created_at)->diffForHumans()}}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                        <td>No submissions</td><td></td><td></td><td></td>
                        </tr>
                    @endif
                    </table>
                    {{ $submissions->links() }}  
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
