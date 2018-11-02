@extends('layouts.student')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-6">
            <h2>Question Manager</h2>

        </div>


    </div>
    @if(Session::has('unsuccess'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Cannot access because Lecturer still reviewing</strong> {{ Session::get('message', '') }}
    </div>
    @endif
    @if(Session::has('unanswer'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>You have already answered.</strong> {{ Session::get('message', '') }}
    </div>
    @endif
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ URL::to('/Student/subject')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ URL::to('/Student/quiz/StudentquizDetail')}}">Quiz Manager</a></li>
            <li class="breadcrumb-item"><a href="{{ URL::to('/Student/question/StudentQuestion')}}">Question Manager</a></li>
        </ol>
    </nav>
 


    <div class="row">
        <table class="table table-bordered">
            <tr>
           <!-- <th style="font-size: 1em;">Number</th> -->
                <th style="font-size: 1em;">Question</th>
                <!-- <th>Description</th> -->
                <!-- <th>Date</th> -->
                <th style="width:50px;">Score</th>
                <th style="width:50px;">min</th>
                <th style="width:50px;">max</th>
                <th style="width:50px;">Avg</th>
                <th></th>


            </tr>
            
            <tbody>
                @foreach($question as $que)
                <tr>
                  <!--  <td style="font-size: 0.8em;">{{$que->number}}</td> -->
                    <td style="font-size: 0.8em;">{{$que->question}}</td>
                    <td style="font-size: 0.8em;">{{$que->score}}</td>
                    <td style="font-size: 0.8em;">{{$que->min}}</td>
                    <td style="font-size: 0.8em;">{{$que->max}}</td>
                    <td style="font-size: 0.8em;">{{$que->avg}}</td> 
                    
                    




                    <td>
                        <a href="{{URL::route('AnswerBlankQuestion.file').'/'.$que->questions_id.'/'.$que->quizs_id}}"
                            class="btn btn-info ">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>


        <hr>
    </div>

</div>



</div>

@endsection
