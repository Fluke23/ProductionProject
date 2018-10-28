@extends('layouts.student')

@section('content')
<div class="container">

    <div class="row mb-2">
        <div class="col-md-3">
            
            <h2 >Quiz Manager</h2>
            </div>
            
            <form class="form-inline">
                    <input class="form-control mr-sm-2 float-right" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0 float-right" type="submit">Search</button>
            </form> 
    </div>
    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ URL::to('/Student/subject')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ URL::to('/Student/quiz/StudentquizDetail')}}">Quiz Manager</a></li>
            </ol>
          </nav>
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
                <th style="width:50px;">Min</th>
                <th style="width:50px;">Max</th>
                <th style="width:50px;">AVG</th>
                
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
                        <td style="font-size: 0.8em;">{{$quiz_min}}</td>
                        <td style="font-size: 0.8em;">{{$quiz_max}}</td>
                        <td style="font-size: 0.8em;">{{$quiz_avg}}</td>
                        
                    

                        <td >
                            <a href="{{URL::to('/Student/question/StudentQuestion/'.$q->quizs_id)}}" class="btn btn-info ">View</a>
                            
                        </td>
                </tr>
                     @endforeach
            </tbody>
 
        </table>
        
         
         <hr>
    </div>


</div>

</div>
</div>






@endsection
