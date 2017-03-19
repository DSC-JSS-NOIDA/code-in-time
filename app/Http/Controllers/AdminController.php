<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Question;
use App\Rules;
use App\Submission;
use File;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
    	$question_model = new Question;
    	$questions = $question_model->getallques();
    	$counter = 1;
    	return view('admin.home', compact('questions','counter'));
    }

    public function editor($ques_id)
    {
    	$question_model = new Question;
    	if($question_model->validate($ques_id))
    		$question = $question_model->getquestion($ques_id);
    	else
    		$question = $question_model;
    	return view('admin.dashboard',compact('question','ques_id'));
    }

    public function addques(Request $request)
    {
    	$input_filename = rand().basename($_FILES["input_tc"]["name"]);
    	$output_filename = rand().basename($_FILES["output_tc"]["name"]);


		$question = new Question;
		if(!$question->validate($request->ques_id))
			$question = new Question;
		else
			$question = Question::find($request->ques_id);

    	$question->title = $request->title;
    	$question->details = $request->details;
    	$question->constraint = $request->constraints;
    	$question->sample = $request->sample;
    	$question->input_tc = $input_filename;
    	$question->output_tc = $output_filename;
    	$question->max_score = $request->max_score;
    	$question->current_score = $request->max_score;

    	$target_dir = storage_path().'/testcases/';//"storage/testcases/";
    	$input_target_file = $target_dir . $input_filename;
    	$output_target_file = $target_dir . $output_filename;

    	if (file_exists($input_target_file))
    		return "Input Filename Already Exists";
    	if (file_exists($output_target_file))
    		return "Output Filename Already Exists";

         if ( !file_exists($target_dir) ) {
             $oldmask = umask(0);  // helpful when used in linux server  
             mkdir ($target_dir, 0744);
         }

		move_uploaded_file($_FILES["input_tc"]["tmp_name"], $input_target_file);
		move_uploaded_file($_FILES["output_tc"]["tmp_name"], $output_target_file);

		$question->save();
    	return redirect('/admin');
    }
}