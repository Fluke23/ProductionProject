@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-3">
            <h2 >Quiz Manager</h2>
            </div>
            <div class="col-md-9">
          
                </div>   
    </div>
    <div class="row">
        <table class="table table-bordered">
            <tr>
                <th style="font-size: 1em;">Title</th>
                <th>Description</th>
                <th>Date</th>
                <th style="width:50px;">Subject</th>
                <th style="width:50px;">Group</th>
                <th style="width:50px;">Type</th>
                <th style="width:50px;">Status</th>
                <th></th>
                

            </tr>

            <tbody>
                    @foreach($quizzes as $q)
                <tr>
                        <td style="font-size: 0.8em;">{{$q->title}}</td>
                        <td style="font-size: 0.8em;">{{$q->description}}</td>
                        <td style="font-size: 0.8em;">{{$q->quiz_date}}</td>
                        <td style="font-size: 0.8em;">{{$q->subject_id}}</td>
                        {{-- name is from group_name --}}
                        <td style="font-size: 0.8em;">{{$q->group_name}}</td>
                        <td style="font-size: 0.8em;">{{$q->type_name}}</td>  
                        <td style="font-size: 0.8em;">{{$q->status_name}}</td>
                        
                    

                        <td >
                            <a href="{{URL::to('/Admin/question/'.$q->quizs_id)}}" class="btn btn-info ">View</a>
                            <a href="{{ URL::to('/Admin/quiz/editQuiz/'.$q->quizs_id) }}" class="btn btn-warning ">Edit</a>
                        </td>
                </tr>
                     @endforeach
            </tbody>
 
        </table>
        
         
         <hr>
    </div>


</div>
@endsection
