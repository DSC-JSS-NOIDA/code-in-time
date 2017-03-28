<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Question extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','details','constraint','sample','input_tc','output_tc','max_score','current_score','currect_sub','attempted'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public function getallques()
    {
        $questions = self::all()->where('active',1);
        return $questions;
    }
    
    public function getquestion($ques_id)
    {
        $question = self::where('id',$ques_id)->first();
        return $question;
    }

    public function validate($ques_id)
    {
        $question = self::where('id',$ques_id)->first();
        if(empty($question))
            return 0;
        else
            return 1;
    }

    public function update_cur_marks($ques_id){
        $question=self::find($ques_id);
        
        $question->current_score=($question->current_score>=40)?$question->current_score/=2:10;
        $question->correct_sub++;
        $question->save();
    }

    public function increment_attempted($ques_id){
        $question=self::find($ques_id);
        $question->attempted++;
        $question->save();

    }
}
