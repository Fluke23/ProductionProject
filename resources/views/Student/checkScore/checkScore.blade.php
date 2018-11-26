@extends('layouts.student')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-6">
            <h2>Review </h2>

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
                        </div>

                     

                       <div class="col-md-6">
                            <strong>   Question : </strong> {{$q->question}}
                       </div>

                        <div class="col-md-6">
                            <strong> Answer Date: </strong>{{$q->answer_date}}
                       </div>

                        <div class="col-md-6">
                         <strong>  Answer No : </strong>{{$q->number}}
                       </div>

                         <div class="col-md-6">
                          <strong> Solution : </strong>{{$q->solution}}
                       </div>

                       <div class="col-md-6">
                        <strong>  Score Student : </strong>{{$q->Score}}
                       </div>


                       <div class="col-md-6">
                        <strong>  Score : </strong>{{$q->score}}
                       </div>

                
                       <div class="col-md-6">
                          <strong> Student : </strong>{{$q->username}} {{$q->firstname}} {{$q->lastname}}
                       </div>

                       
                      
                       
                       
                       
                     
        @if($questionType == 'Multiple')
            @foreach($correct as $c)
            @endforeach
                @if($q->answer == $c->choice)
                <div class="col-md-4">
                    <button type="button" class="btn btn-success">
                        Correct Answer
                    </button>
                </div>
                @else
                <div class="col-md-4">
                    <button type="button" class="btn btn-danger">
                        Incorrect Answer
                    </button>
                </div>
                @endif
        @elseif($questionType == 'TrueFalse')
                @if($q->answer == $q->solution)
                <div class="col-md-4">
                    <li class="list-group">Solution: {{$q->solution}}</li>
                </div>

                <div class="col-md-4">
                    <button type="button" class="btn btn-success">
                        Correct Answer
                    </button>
                </div>
                @else
                <div class="col-md-4">
                    <button type="button" class="btn btn-danger">
                        Incorrect Answer
                    </button>
                </div>
                @endif        
        @endif
                    
                     
                     <div class="col-md-12 mt-4 mb-4">
                     {{--  {{Form::label('Answer:', 'Answer :')}}</br>  --}}
                        <strong>Answer : </strong>
                        <textarea name="Answer:" cols="120" rows="10" id="Answer:" 
                        style="margin-top: 0px; margin-bottom: 0px; height: 170px;" class="form-control" readonly>   {{$q->answer}}</textarea>
                     </div>  
                     

                      @foreach($question as $q)

                     <div class="col-md-12">
                        {{--  {{Form::label('remark:', 'remark:')}}</br>  --}}
                        <strong> Comment : </strong>
                        ( {{$q->usernames}}  {{$q->created_at}} )
                        <p class="bg-light p-2 border border-primary rounded" name="Remark:" cols="120" rows="10" id="Answer:" readonly> {{$q->comment}}</p>
                        
                     </div></br>

                     @endforeach

        <div class="container">
        <div class="row">
            <br>
            <form action="{{route('checkScore.file')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="col-md-12 mt-5">
                     {{--  {{Form::label('Remark:', 'Comment :')}}</br>  --}}
                                             <strong> Comment : </strong>
                     <textarea name="Remark" cols="120" rows="5" id="Remark" 
                     style="margin-top: 0px; margin-bottom: 0px; height: 100px;" class="form-control">   </textarea>
                </div>

              

                <div class="col-md-4">
                   
                     {{Form::hidden('questions_id',$questions_id)}}</br>
                     
                </div>
            </br>

                 
                <div class="col-md-12 text-right ">
                                    <a class="btn btn-danger mr-2 px-4" href="{{url()->previous()}}">Cancel</a>

                    <button type="submit" class="btn btn-primary px-5">Save</button>
                    <!-- <input class="btn btn-primary" type="submit">Submit -->
                </div>

    @endsection