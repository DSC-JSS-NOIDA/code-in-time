@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if(empty($question))
                        <div>Invalid Question</div>
                    @else
                        <div>{{$question->title}}</div>
                    @endif

                <div class="panel-body">
                    @if(empty($question))
                        <h1>Question Brewing Up</h1>
                    @else

                        <h4>Stats:</h4>
                        Max Score: {{$question->max_score}} |
                        Current Score: {{$question->current_score}} |
                        Correct Submissions: {{$question->correct_sub}} |
                        Attempts: {{$question->attempted}}
                        <hr/>

                        <h4>Details:</h4>
                        {{$question->details}}
                        <hr/>

                        <h4>Constraints:</h4>
                        {{$question->constraint}}
                        <hr/>

                        <h4>Sample TestCase:</h4>
                        {{$question->sample}}
                        <hr/>

                        <form action="{{URL::to('/submission')}}" method="post">
                            {{csrf_field()}}
                            <input type="hidden" value="{{$question->id}}" name="ques_id" />
                            <textarea></textarea>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
