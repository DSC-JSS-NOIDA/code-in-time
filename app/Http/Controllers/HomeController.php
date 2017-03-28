<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Question;
use App\Rules;
use App\Submission;
use App\User;
use File;
use Illuminate\Support\Facades\Storage;
use Unirest;

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

        $submission_model = new Submission;
        $submissions = $submission_model->get_all_submissions();

        $ques_counter = 1;
        return view('home',compact('questions','ques_counter','submissions'));
    }

    public function rules()
    {
        $rules_model = new Rules;
        $rules = $rules_model->getallrules();
        $rules_counter = 1;
        return view('rules',compact('rules','rules_counter'));
    }

    public function leaderboard(){
        $user_model = new \App\User;
        $users = $user_model->get_users();
        return view('leaderboard',['users'=>$users]);
    }
    public function question($ques_id)
    {
        $question_model = new Question;
        $question = $question_model->getquestion($ques_id);
        
        if($question->active){

        $submission_model = new \App\Submission;
        $submissions = $submission_model->get_question_submissions($ques_id);

        return view('question',compact('question','submissions'));
        }
        else
        {
            return "try something else..";
        }
    }

    public function submission(Request $request)
    {
        $ques_id = $request->ques_id;
        $source = $request->source;
        $lang = $request->lang;

        $question_model = new Question;
        $validate_ques = $question_model->validate($ques_id);

        if($validate_ques && !empty($source) && !empty($lang))
        {
            $question = $question_model->getquestion($ques_id);
            $input_file = $question->input_tc;
            $output_file = $question->output_tc;
            $source = urlencode($source);

            $input_tc = trim(File::get(storage_path('testcases/'.$input_file)));
            $output_tc = trim(File::get(storage_path('testcases/'.$output_file)));
            $url = 'https://api.hackerearth.com/v3/code/run/';
            $parameters="client_secret=".env('HACKEREARTH_SECRET')."&source=".$source."&lang=".$lang."&input=".$input_tc."&time_limit=2";

            // $ch = curl_init();
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($ch, CURLOPT_URL, $url);
            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            // curl_setopt($ch, CURLOPT_POST,$input_tc);
            // curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // $response = curl_exec($ch);
            // $response = json_decode($response);

            $response = Unirest\Request::post("https://ideas2it-hackerearth.p.mashape.com/compile/",
              array(
                "X-Mashape-Key" => "Gp4jkbZcOpmsheLtgXfNKCwwjN5Jp1TLeO2jsnmcEujniWK7wu",
                "Content-Type" => "application/x-www-form-urlencoded",
                "Accept" => "application/json"
              ),
              array(
                "async" => 0,
                "client_secret" => env('HACKEREARTH_SECRET'),
                "lang" => $lang,
                "memory_limit" => 262144,
                "source" => $source,
                "time_limit" => 5
              )
            );

            var_dump($response);    
            $marks_scored = 0;
            if($response->run_status->status=="CE")
            {
                $status = "CE";
                echo "Compilation Error";
                echo $response->compile_status;
            }
            else if($response->compile_status=="OK" && $response->run_status->status=="TLE")
            {
                $status = "TLE";
                $question->increment_attempted($ques_id);
                echo "Time Limit Exceeded";
                echo "Time Used:" . $response->run_status->time_used;
            }
            else if($response->compile_status=="OK" && $response->run_status->status=="RE")
            {
                $status = "RE";
                $question->increment_attempted($ques_id);
                echo "Runtime Error";   
            }
            else if($response->compile_status=="OK" && $response->run_status->status=="AC")
            {
                $output = trim($response->run_status->output);
                if($output_tc==$output)
                {
                    $status = "AC";
                    
                    $user_model = new User;
                    
                    $marks_scored=$user_model->update_marks(Auth::user()->id,$ques_id);
                    if($marks_scored)
                    $question_model->update_cur_marks($ques_id);
                    
                    
                    $question->increment_attempted($ques_id);
                    echo "Correct Answer";
                }
                else
                {
                    $status = "WA";
                    $question->increment_attempted($ques_id);
                    echo "Wrong Answer";
                }
            }

            $submission_model = new Submission;
            $submission_model->add_submission($question->id, Auth::user()->id, $status, $marks_scored);

            return;
        }
        else
        {
            return "Question Doesn't Exist";
        }
        return view('submission',compact('response'));
    }
}
