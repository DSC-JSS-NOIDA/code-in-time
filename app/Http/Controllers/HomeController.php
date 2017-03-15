<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Rules;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $question_model = new Question;
        $questions = $question_model->getallques();
        $ques_counter = 1;
        return view('home',compact('questions','ques_counter'));
    }

    public function rules()
    {
        $rules_model = new Rules;
        $rules = $rules_model->getallrules();
        $rules_counter = 1;
        return view('rules',compact('rules','rules_counter'));
    }

    public function question($ques_id)
    {
        $question_model = new Question;
        $question = $question_model->getquestion($ques_id);
        return view('question',compact('question'));
    }

    public function submission(Request $request)
    {
        $ques_id = $request->ques_id;
        
        return view('submission');
    }
}
