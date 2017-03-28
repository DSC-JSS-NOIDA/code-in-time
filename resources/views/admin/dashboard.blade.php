@extends('layouts.app')

@section('content')
	<br>
	<div class="container">
		<form action="/addques" method="post" enctype="multipart/form-data">
			{{csrf_field()}}
			<input type="hidden" name="ques_id" value="{{$ques_id}}">
			<div class="form-group">
			  <label for="title">Title:</label>
			  <input type="text" class="form-control" name="title" id="title" value="{{$question->title}}" required="">
			</div>
 			<div class="form-group">
			  <label for="details">Details:</label>
			  <textarea class="form-control" rows="3" name="details" id="details" required="">{{$question->details}}</textarea>
			</div>			
			<div class="form-group">
			  <label for="constraints">Constraints:</label>
			  <textarea class="form-control" rows="4" name="constraints" id="constraints" value="" required="">{{$question->constraint}}</textarea>
			</div>			
			<div class="form-group">
			  <label for="sample">Sample:</label>
			  <textarea class="form-control" rows="4" name="sample" id="sample" value="{{$question->sample}}" required="">{{$question->sample}}</textarea>
			</div>			
			<div class="form-group">
			  <label for="input_tc">Input TC:</label>
			  <input type="file" name="input_tc" id="input_tc" required=""><a href="/download/{{$question->input_tc}}">Download</a>
			</div>
			<div class="form-group">
			  <label for="output_tc">Output TC:</label>
			  <input type="file" name="output_tc" id="output_tc" required=""><a href="/download/{{$question->output_tc}}">Download</a>
			</div>
			<div class="form-group">
			  <label for="max_score">Max Score:</label>
			  <input type="number" name="max_score" id="max_score" value="{{$question->max_score}}" required="">
			</div>
			<div class="form-group">
			  <label for="cur_score">Current Score:</label>
			  <input type="number" name="cur_score" id="cur_score" value="{{$question->current_score}}" required="">
			</div>
			<div class="form-group">
			  <label for="active">Active(0 or 1):</label>
			  <input type="number" name="active" id="active" value="{{$question->active}}" required="">
			</div>
			<input type="submit" name="submit" value="Add Question">
		</form>
	</div>
@endsection
