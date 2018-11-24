@extends('layouts.student')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-6">
            <h2>Answer Question </h2>

        </div>


    </div>


    <div class="row">


        @foreach($answer3 as $a)
        @endforeach
        <ul class="list-group">
        
            <li class="list-group">Question:{{$a->question}} (Please Choose {{$a->answer_row}} Correct Answer)</li>
            <li class="list-group">Score:{{$a->score}}</li>



        </ul>
        
        <hr>
    </div>
    <div class="container">
        <div class="row">
            <br>
            <form action="{{route('editAnswerMultiple.file', $answer_id)}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                {{csrf_field()}}
                            @foreach ($answer3 as $key => $q2)
                                @if($q2->answer_row > 1)
                                    <div class="form-group">
                                        {{$q2->choice}}
                                        {{Form::checkbox('answer',$q2->choice)}}
                                        {{Form::hidden ('choice_id', $q2->choice_id)}}
                                    </div>
                                @else
                                    <div class="form-group">
                                        {{$q2->choice}}
                                        {{Form::radio('answer',$q2->choice)}}
                                        {{Form::hidden ('choice_id', $q2->choice_id)}}
                                    </div>
                                @endif
                            @endforeach


                            <div class="form-group">
                                {{Form::hidden ('1', '1',['id' => 'index'])}}
                            </div>

                            <div class="form-group">
                                {{Form::hidden('answer_id',$answer_id)}}
                            </div>

                            <div class="form-group">
                                <button type="button" class="btn btn-danger">Cancel</button>
                                <input class="btn btn-success" type="submit">
                            </div>
                        </div>       
            </form>
        </div>
    </div>
    @endsection