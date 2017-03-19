@extends('layouts.app')

@section('content')
	<center><h2>{{$success}}</h2></center>
	<br>
	<div class="container">
		<form action="/addques" method="post" enctype="multipart/form-data">
			{{csrf_field()}}
			<div class="form-group">
			  <label for="title">Title:</label>
			  <input type="text" class="form-control" name="title" id="title" required="">
			</div>
 			<div class="form-group">
			  <label for="details">Details:</label>
			  <textarea class="form-control" rows="3" name="details" id="details" required=""></textarea>
			</div>			
			<div class="form-group">
			  <label for="constraints">Constraints:</label>
			  <textarea class="form-control" rows="4" name="constraints" id="constraints" required=""></textarea>
			</div>			
			<div class="form-group">
			  <label for="sample">Sample:</label>
			  <textarea class="form-control" rows="4" name="sample" id="sample" required=""></textarea>
			</div>			
			<div class="form-group">
			  <label for="input_tc">Input TC:</label>
			  <input type="file" name="input_tc" id="input_tc" required="">
			</div>
			<div class="form-group">
			  <label for="output_tc">Output TC:</label>
			  <input type="file" name="output_tc" id="output_tc" required="">
			</div>
			<div class="form-group">
			  <label for="max_score">Max Score:</label>
			  <input type="number" name="max_score" id="max_score" required="">
			</div>

			<input type="submit" name="submit" value="Add Question">
		</form>
	</div>
@endsection
