<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Rules;
use File;
use Illuminate\Support\Facades\Storage;

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

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_POST,$input_tc);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            $response = json_decode($response);

            if($response->run_status->status=="CE")
            {
                echo "Compilation Error";
                echo $response->compile_status;
            }
            else if($response->compile_status=="OK" && $response->run_status->status=="TLE")
            {
                echo "Time Limit Exceeded";
                echo "Time Used:" . $response->run_status->time_used;
            }
            else if($response->compile_status=="OK" && $response->run_status->status=="RE")
            {
                echo "Runtime Error";   
            }
            else if($response->compile_status=="OK" && $response->run_status->status=="AC")
            {
                $output = trim($response->run_status->output);
                if($output_tc==$output)
                    echo "Correct Answer";
                else
                    echo "Wrong Answer";
            }
            var_dump($output_tc);
            var_dump($output);
            return;
        }
        else
        {
            return "Question Doesn't Exist";
        }
        return view('submission',compact('response'));
    }
}
