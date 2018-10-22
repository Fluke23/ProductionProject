@extends('layouts.lecturer')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-3">
            <h2 >Question Manager</h2>
            </div>
            <div class="col-md-9">
            <div class="btn-group float-right">
                 <button type="button" class="btn btn-success dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Add Question
                 </button>
            <div class="dropdown-menu">
            <a class="dropdown-item"  
                        href="/Lecturer/question/blankQuestion/{{$quizs_id}}">BlankQuestion</a>
                        <!-- href="{{ URL::to('/question/blankQuestion/')}}">BlankQuestion</a> -->
                <a class="dropdown-item"  
                        href="/Lecturer/question/shortAnswer/{{$quizs_id}}">shortAnswer</a> 
                <a class="dropdown-item" 
                 href="/Lecturer/question/UploadQuestion/{{$quizs_id}}">UploadQuestion</a> 
                <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/Lecturer/question/MultipleChoice/{{$quizs_id}}">MultipleQuestion</a>
                    <a class="dropdown-item" href="/Lecturer/question/TrueFalse/{{$quizs_id}}">TrueFalseQuestion</a>
            </div>
      </div>       
            </div>   
    </div>


    <div class="row">
        <table class="table table-bordered">
            <tr>
                <th style="font-size: 1em;">Number</th>
                <th>Question</th>
                <th style="width:50px;">Score</th>
                <th style="width:50px;">Type</th>
                <th></th>
                

            </tr>

            <tbody>
                    @foreach($question as $q)
                <tr>
                        <td style="font-size: 0.8em;">{{$q->number}}</td>
                        <td style="font-size: 0.8em;">{{$q->question}}</td>
                        <td style="font-size: 0.8em;">{{$q->score}}</td>
                        <td style="font-size: 0.8em;">{{$q->questions_types_id}}</td>
                    

                        <td >
                            <a href="{{URL::to('/Lecturer/question/'.$q->quizs_id)}}" class="btn btn-info ">View</a>
                            <a href="{{ URL::to('/Lecturer/question/editQuestion/'.$q->quizs_id) }}" class="btn btn-warning ">Edit</a>
                            <a href="{{ URL::to('/Lecturer/question/deleteQuestion/'.$q->questions_id.'/'.$q->quizs_id)}}" class="btn btn-danger">Delete</a>
                        </td>
                </tr>
                     @endforeach
            </tbody>
 
        </table>
        
         
         <hr>
    </div>


</div>
@endsection
