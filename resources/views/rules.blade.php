@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Rules</div>

                <div class="panel-body">
                    @if(!empty($rules))
                        <table class="table">
                            <tr>
                                <th>Sr. No.</th>
                                <th>Rule</th>
                            </tr>
                            @foreach($rules as $rule)
                                <tr>
                                    <td>{{$rules_counter++}}</td>
                                    <td>{{$rule->rule}}</td>
                                </tr>   
                            @endforeach
                        </table>
                    @else
                        <h1>Rules Brewing Up</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
