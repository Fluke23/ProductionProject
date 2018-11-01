@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-4">
            <h2 >Question Manager</h2>
            </div>
            <div class="col-md-8">
            <div class="btn-group float-right">
                 <button type="button" class="btn btn-success dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Add Question
                 </button>
            <div class="dropdown-menu">
            <a class="dropdown-item"  
                        href="/Admin/question/blankQuestion/{{$quizs_id}}">BlankQuestion</a>
                        <!-- href="{{ URL::to('/question/blankQuestion/')}}">BlankQuestion</a> -->
                <a class="dropdown-item"  
                        href="/Admin/question/shortAnswer/{{$quizs_id}}">shortAnswer</a> 
                <a class="dropdown-item" 
                 href="/Admin/question/UploadQuestion/{{$quizs_id}}">UploadQuestion</a> 
                <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/Admin/question/MultipleChoice/{{$quizs_id}}">MultipleQuestion</a>
                    
                    {{--  {{Form::text($amount,'amount')}}  --}}
                    <a class="dropdown-item" href="/Admin/question/TrueFalse/{{$quizs_id}}">TrueFalseQuestion</a>
            </div>
      </div>       
            </div>   
    </div>

    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/subject')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/quiz/')}}">Quizmanager</a></li>
              
              <li class="breadcrumb-item"><a href="{{URL::to('/Admin/question/'.$quizs_id)}}" >{{$quizs_id}}</a></li>
              
            </ol>
          </nav>

    <div class="row">
        <table class="table table-bordered">
            <tr>
                <th style="font-size: 1em;">Number</th>
                <th>Question</th>
                <th style="width:50px;">Score</th>
                <th style="width:50px;">Type</th>
                <th style="width:50px;">Min</th>
                <th style="width:50px;">Max</th>
                <th style="width:50px;">AVG</th>
                <th></th>
                

            </tr>

            <tbody>
                    @foreach($question as $q)
                <tr>
                        <td style="font-size: 0.8em;">{{$q->number}}</td>
                        <td style="font-size: 0.8em;">{{$q->question}}</td>
                        <td style="font-size: 0.8em;">{{$q->score}}</td>
                        <td style="font-size: 0.8em;">{{$q->questions_types_id}}</td>
                        <td style="font-size: 0.8em;">{{$q->min}}</td>
                        <td style="font-size: 0.8em;">{{$q->max}}</td>
                        <td style="font-size: 0.8em;">{{$q->avg}}</td>

                        <td >
                        @if($q->questions_types_id == 'Multiple' || $q->questions_types_id == 'TrueFalse')
                        <a href="{{URL::to('/Admin/checkMultipleAnswer/indexAnswer/'.$q->questions_id)}}" class="btn btn-info ">View</a>
                        @else
                        <a href="{{URL::to('/Admin/checkAnswer/indexAnswer/'.$q->questions_id)}}" class="btn btn-info ">View</a>
                        @endif
                        {{--  <a href="{{ URL::to('/Admin/quiz/editQuiz/'.$q->quizs_id) }}" class="btn btn-warning ">Edit</a>  --}}
                            <a href="{{ URL::to('/Admin/question/deleteQuestion/'.$q->questions_id.'/'.$q->quizs_id)}}" class="btn btn-danger">Delete</a>
                        </td>
                </tr>
                     @endforeach
            </tbody>
 
        </table>
        
         
         <hr>
    </div>


</div>
@endsection
