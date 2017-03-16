<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class Submission extends Authenticatable
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
        
    ];

    public function get_all_submissions(){
        $submissions = DB::table('submissions')
            ->join('questions', 'questions.id','=','submissions.ques_id')
            ->join('users','users.id','=','submissions.user_id')
            ->select('users.name', 'submissions.status', 'submissions.*','questions.title')
            ->latest()
            ->paginate(5);
        return $submissions;
    }

}
