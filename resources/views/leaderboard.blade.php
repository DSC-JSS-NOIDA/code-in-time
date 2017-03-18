@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Leaderboard</div>

                <div class="panel-body">
                    <table class="table">
                    <tr>
                        <th>Sr. No</th>
                        <th>Username</th>
                        <th>Score</th>
                        <th>Solved Questions</th>
                    </tr>

                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->score}}</td>
                            <td>{{$user->solved_ques}}</td>
                        </tr>
                    @endforeach
                    
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
