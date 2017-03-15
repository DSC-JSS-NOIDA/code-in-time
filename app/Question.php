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
        $questions = self::all();
        return $questions;
    }
    
    public function getquestion($ques_id)
    {
        $question = self::where('id',$ques_id)->first();
        return $question;
    }
}
