@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-3">
            <h2>Show User Score</h2>
        </div>
        <div class="float-right col-md-9 ">
               <a href="{{ route('exportScore',['quizs_id'=>$quizs_id]) }}" class="btn btn-success ml-3">Export Score</a>
        </div>
    </div>
    {{--  Breadcrumb  --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/subject')}}">Home</a></li>
            {{--  <li class="breadcrumb-item"><a href="{{ route('showQuizScore')}}">{{}}</a></li>  --}}
            
        </ol>
    </nav>
    {{--  Breadcrumb  --}}

    @foreach($quiz as $q)
    <div class="row">
         
        <div class="col-md-6">
            <p><strong>Quiz Name : </strong> {{$q->title}}</p>  
        </div>
          <div class="col-md-6">
            <p><strong>Quiz Description : </strong> {{$q->description}}</p>  
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
             <p><strong>Subject : </strong> {{$q->subject_id}} {{$q->subject_name}}</p>  
        </div>

        <div class="col-md-6">
             <p><strong>Quiz Date : </strong> {{$q->quiz_date}}</p>  
        </div>
    </div>
     @endforeach
     <div class="row">
        <div class="col-md-3">
            <p><strong>Total Score : </strong> {{$quiz_total}}</p> 
        </div>
        <div class="col-md-3">
            <p><strong>Min : </strong> {{$min_score}}</p> 
        </div>
        <div class="col-md-3">
            <p><strong>Max : </strong> {{$max_score}}</p> 
        </div>
        <div class="col-md-3">
            <p><strong>Avg : </strong> {{$avg_score}}</p> 
        </div>
       
     </div>


    <div class="col-md-12">
        <table id="table">
        <thead>
        <tr>
                <th width="10%">Username</th>
                <th width="10%">Firstname</th>
                <th width="10%">Lastname</th>
                <th width="7%">Score</th>
        </tr>
        </thead>
            
            <tbody>
                @foreach($user as $u)
                <tr>
                    <td>{{$u->username}} </td>
                    <td>{{$u->firstname}}</td>
                    <td>{{$u->lastname}}</td>
                    <td>{{$u->Score}}</td>
                </tr>
                @endforeach
            </tbody>

        </table>


        <hr>
    
    </div>

</div>




@endsection
