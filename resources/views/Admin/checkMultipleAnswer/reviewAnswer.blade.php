@extends('layouts.main')

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
            
           
            
        </div></br>

        <div class="col-md-12">
            <h4>{{$q->title}}</h4>
        </div>

        <div class="col-md-12 my-3">
                <strong> Question : </strong>  {{$q->question}}
        </div>

         <div class="col-md-6 mb-3">
           <strong> Answer Date : </strong>  {{$q->answer_date}}
        </div>

         <div class="col-md-6 mb-3s">
           <strong>Answer No : </strong>  {{$q->number}}
        </div>

        <div class="col-md-6 mb-3">
             <strong> Score : </strong>  {{$q->score}}
        </div>

       

        @foreach($question as $q)
        @endforeach

        <div class="col-md-6 mb-3">
            Student: {{$q->username}}
        </div>

       

    @if($q->solution != NULL)
        <div class="col-md-12">
            Solution: {{$q->solution}}
        </div>
    @endif
    
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


        <div class="col-md-12 mt-3">
            <!-- {{Form::label('Answer:', 'Answer:')}}</br> -->
            <strong>Answer : </strong> <br>
            <textarea class="form-control" name="Answer:" cols="120" rows="10" id="Answer:" style="margin-top: 0px; margin-bottom: 0px; height: 170px;"
                readonly>   {{$q->answer}}</textarea>
        </div>

    </div></br>



    <div class="container">
        <div class="row">
            <br>
            <form action="{{route('reviewMultipleAnswer.file')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="col-md-12 mb-3">
                    <!-- {{Form::label('Remark:', 'Remark:')}}</br> -->
                    <strong>Remark : </strong> <br>
                    <textarea class="form-control" name="Remark" cols="120" rows="5" id="Remark" style="margin-top: 0px; margin-bottom: 0px; height: 100px;">   </textarea>
                </div>


    @if($questionType == 'Multiple')
            @foreach($correct as $c)
            @endforeach
                @if($q->answer == $c->choice)
                    <div class="col-md-4">
                        <!-- {{Form::label('Score:', 'Score:')}}</br> -->
                        <strong> Score : </strong> <br>
                        {{Form::text('Score', '1',['class'=>'form-control','placeholder'=> 'Score'])}}
                    </div>
                @else
                    <div class="col-md-4">
                            <!-- {{Form::label('Score:', 'Score:')}}</br> -->
                            <strong> Score : </strong> <br>
                            {{Form::text('Score', '0',['class'=>'form-control','placeholder'=> 'Score'])}}
                    </div>
                @endif
    @elseif($questionType == 'TrueFalse')
                @if($q->answer == $q->solution)
                    <div class="col-md-4">
                        <!-- {{Form::label('Score:', 'Score:')}}</br> -->
                        <strong> Score : </strong> <br>
                        {{Form::text('Score', '1',['class'=>'form-control','placeholder'=> 'Score'])}}
                    </div>
                @else
                    <div class="col-md-4">
                            <!-- {{Form::label('Score:', 'Score:')}}</br> -->
                            <strong> Score : </strong> <br>
                            {{Form::text('Score', '0',['class'=>'form-control','placeholder'=> 'Score'])}}
                    </div>
                @endif

    @endif

                <div class="col-md-4">
                    {{Form::hidden('questions_id',$questions_id)}}</br>

                </div>

                <div class="col-md-4">
                    {{Form::hidden('quiz_id',$quiz_id)}}</br>
                </div>

                </br>
        <hr>
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary px-5">Save</button>
                    <!-- <input class="btn btn-primary" type="submit">Submit -->
                    <a class="btn btn-dark px-5" href="{{URL::to('/Admin/question/'.$quiz_id)}}">Back</a>
                </div>


                @endsection