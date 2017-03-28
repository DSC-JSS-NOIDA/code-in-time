<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','college','year','mobile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function get_users(){
        return self::all();
    }

    public function update_marks($user_id,$quest_id){
        $question_model = new \App\Question;
        $question = $question_model->getquestion($quest_id);

        $user=self::find($user_id);
        if(strpos($user->solved_ques, $question->title)===false)
        {
            $user->score=$user->score+$question->current_score;
            $user->solved_ques = $user->solved_ques.$question->title."(".$question->current_score.")";
            $user->save();
            return $question->current_score;
        }
        return 0;
    }
    
    public function isAdmin()
    {
        return $this->role; // this looks for an admin column in your users table
    }

}
