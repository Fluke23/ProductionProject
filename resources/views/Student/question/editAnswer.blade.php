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
      
            <img src="{{$q->img_url}}" width="50%" height="50$">

            <!-- <li class="list-group">Number: {{$key + 1}}</li> -->

            <div class="col-md-12 mb-3 mt-3">
                 <strong> Question : </strong> {{$q->question}}
            </div>
            
            <div class="col-md-12 mb-3">
                <strong>Solution : </strong>  {{$q->solution}}
            </div>


            <div class="col-md-12 mb-3">
                   <strong> Score : </strong>{{$q->score}}
            </div>
         
        @endforeach
        <hr>
    </div>
    <div class="container">
        <div class="row">
            <br>
            <form action="{{route('editAnswer.file', $answer_id)}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                {{csrf_field()}}
                    
                        <div class="form-group">
                            {{Form::hidden ('1', '1', ['id' => 'index'])}}

                        </div>

                        <div class="form-group">
                        @foreach($answer as  $q)
                        <hidden name="Answer:" cols="120" rows="10" id="answer_id" 
                            style="margin-top: 0px; margin-bottom: 0px; height: 219px;"></textarea>
                        @endforeach
                        </div>
                        
                        <div class="form-group">
                            {{Form::hidden('answer_id',$answer_id)}}
                        </div>

                        

                        <div class="form-group">
                            {{--  {{Form::label('Answer', 'Answer')}}  --}}
                            <strong>Answer : </strong>
                            @foreach($answer as  $q)
                            
                            <textarea name="answer" cols="120" rows="10" id="answer" 
                            style="margin-top: 0px; margin-bottom: 0px; height: 170px;" class="form-control">  {{$q->answer}}</textarea>
                            @endforeach
                        </div>
                       

{{--  
                        <div class="form-group">
                            <button type="button" class="btn btn-danger">Cancel</button>
                            
                                <input class="btn btn-success" type="submit">
                        </div>  --}}
                        <div class="col-md-12 text-right">
                 
                    <a class="btn btn-dark mr-2 px-4" href="{{url()->previous()}}">Back</a>

                    <input class="btn btn-success px-4" type="submit">

                </div>

            </form>
        </div>
    </div>


    @endsection