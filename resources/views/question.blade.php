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

                        <form action="{{URL::to('/submission')}}" method="post" id="form">
                            {{csrf_field()}}
                            <input type="hidden" value="{{$question->id}}" name="ques_id" readonly="" />
                            <div class="form-group">
                              <label for="lang">Select Language:</label>
                              <select class="form-control" id="lang" required="" name="lang">
                                <option lang="c_cpp" value="C">C</option>
                                <option lang="c_cpp" value="CPP">C++</option>
                                <option lang="java" value="JAVA">Java</option>
                                <option lang="python" value="PYTHON">Python</option>
                              </select>
                            </div>     
                            <input type="hidden" name="source" value="" class="source">
                            <textarea type="text" id="editor"></textarea>
                            <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.6/ace.js" type="text/javascript" charset="utf-8"></script>
<script>
    $(document).ready(function(){
    
        var editor = ace.edit("editor");
        editor.setTheme("ace/theme/twilight");

        editor.setAutoScrollEditorIntoView(true);
        editor.setOption("maxLines", 20);
        editor.setOption("minLines", 8);

        var lang = "c_cpp";

        $("#lang").change(function(){
            $("#lang option:selected").each(function(){
                lang = $(this).attr('lang');
                console.log(lang);
                editor.session.setMode("ace/mode/"+lang);
            })
        });

        editor.getSession().on("change", function () {
          $(".source").val(editor.getSession().getValue());
        });

    });

</script>
@endsection
