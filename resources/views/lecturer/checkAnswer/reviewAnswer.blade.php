@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-6">
            <h2>Review</h2>

        </div>


    </div>
    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/subject')}}">Home</a></li>
            </ol>
        </nav>

    <div class="row">
        
                    @foreach($question as $q)
                    @endforeach
               
                    <div class="col-md-12">
                        <h4>{{$q->title}}</h4>
                        <img src="{{$q->img_url}} "width="100%" height="400%">
                        <li class="list-group">solution: {{$q->solution}}</li>
                        <li class="list-group">Question:{{$q->question}}</li>
                        

                     </div></br>
                     
                   
                     <div class="col-md-4">
                     <li class="list-group">Answer No: {{$q->number}}</li>
                     </div>
                     @foreach($question as $q)
                     @endforeach
                     <div class="col-md-4">
                     <li class="list-group">Student: {{$q->username}}</li>
                     </div>
                     
                     <div class="col-md-4">
                     <li class="list-group">Answer Date: {{$q->answer_date}}</li>
                     </div>

                     
                    
                     <div class="col-md-12">
                     {{Form::label('Answer:', 'Answer:')}}</br>
                     
                     
                     @if($q->questions_types_id =='Upload')
                     <a name="Answer:" cols="120" rows="10" id="Answer:" 
                     style="margin-top: 0px; margin-bottom: 0px; height: 219px;" readonly href="{{$q->answer}}">   {{$q->answer}}</a>
                     @else
                     <textarea name="Answer:" cols="120" rows="10" id="Answer:" 
                     style="margin-top: 0px; margin-bottom: 0px; height: 219px;" readonly >   {{$q->answer}}</textarea>
                     @endif
                    
                    
                     
                     </div>  
                     

                     </div></br>

                
               
                    

        <div class="container">
        <div class="row">
            <br>
            <form action="{{route('reviewAnswer.file')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="col-md-12">
                     {{Form::label('Comment:', 'Comment:')}}</br>
                     <textarea name="Remark" cols="120" rows="5" id="Remark" 
                     style="margin-top: 0px; margin-bottom: 0px; height: 100px;">   </textarea>
                </div>

               <div class="col-md-4">
                     {{Form::label('Score:', 'Score:')}}&nbsp;&nbsp;From:{{$q->score}}</br>
                     {{Form::text('Score', '',['class'=>'form-control','placeholder'=> 'Score'])}}
                     
                </div>
                
               
                <div class="col-md-4"> 
                     {{Form::hidden('questions_id',$questions_id)}}</br>
                     
                </div>

                  <div class="col-md-4"> 
                     {{Form::hidden('answer_id',$answer_id)}}</br>
                     
                </div>


                 <div class="form-group">
                   
                    <button type="submit" class="btn btn-primary">Save</button>
                    <!-- <input class="btn btn-primary" type="submit">Submit -->
                </div>
    

    @endsection