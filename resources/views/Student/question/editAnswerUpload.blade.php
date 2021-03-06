@extends('layouts.student')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-6">
            <h2>Answer Question </h2>

        </div>


    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/subject')}}">Home</a></li>
        </ol>
    </nav>



    <div class="row">


        @foreach($answer as $key => $q)
        
            <img src="{{$q->img_url}}" width=" 100%" height="400%"> 
            <a href="{{$q->img_url}}"> {{$q->img_url}}</a> <br>
            <div class="col-md-12 mb-3 mt-3">
               <strong> Number: </strong>{{$key + 1}}
            </div>
            
             <div class="col-md-12 mb-3">
               <strong> Solution :  </strong> {{$q->solution}}
             </div>
           
             <div class="col-md-12 mb-3">
               <strong>Question : </strong>  {{$q->question}}
             </div>

            <div class="col-md-12 mb-3">
               <strong>Score : </strong> {{$q->score}}
            </div>

        @endforeach

        
    </div>
  
    <div class="container">
        <div class="col-md-12">
            <br>
            <form action="{{route('editAnswerUpload.file', $answer_id)}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="form-group">
                    {{Form::hidden ('1', '1', ['id' => 'index'])}}

                </div>

                <div class="form-group">
                    @foreach($answer as $q)
                    <hidden name="Answer:" cols="120" rows="10" id="answer_id" style="margin-top: 0px; margin-bottom: 0px; height: 219px;"></textarea>
                        @endforeach
                </div>

                <div class="form-group">
                    {{Form::hidden('answer_id',$answer_id)}}
                </div>
              
                <div class="form-group">
                    {{--  {{Form::label('Answer', 'Answer')}}<br>  --}}
                    <strong>Answer : </strong>
                    @foreach($answer as $q)
                    <a name="Answer:" cols="120" rows="10" id="Answer:" 
                     style="margin-top: 0px; margin-bottom: 0px; height: 219px;" readonly href="{{$q->answer}}">   {{$q->answer}}</a><br>
                    
                    <input type="file" name="fileName" id="fileName" multiple>
                    @endforeach
                </div>


               <hr>
                <div class="col-md-12 text-right">
                      <hr>
                    <a class="btn btn-dark mr-2 px-4" href="{{url()->previous()}}">Back</a>

                    <input class="btn btn-success px-4" type="submit">

                </div>

            </form>
        </div>
    </div>


    @endsection
