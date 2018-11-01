@extends('layouts.lecturer')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-6">
            <h2>Review </h2>

        </div>


    </div>


    <div class="row">

        @foreach($question as $q)
        @endforeach

        <div class="col-md-12">
            <h4>{{$q->title}}</h4>

            <li class="list-group">Question:{{$q->question}}</li>
            <li class="list-group">Score:{{$q->score}}</li>

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


        <div class="col-md-12">
            {{Form::label('Answer:', 'Answer:')}}</br>
            <textarea name="Answer:" cols="120" rows="10" id="Answer:" style="margin-top: 0px; margin-bottom: 0px; height: 219px;"
                readonly>   {{$q->answer}}</textarea>
        </div>

    </div></br>





    <div class="container">
        <div class="row">
            <br>
            <form action="{{route('reviewMultipleAnswer.file')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="col-md-12">
                    {{Form::label('Remark:', 'Remark:')}}</br>
                    <textarea name="Remark" cols="120" rows="5" id="Remark" style="margin-top: 0px; margin-bottom: 0px; height: 100px;">   </textarea>
                </div>

                <div class="col-md-4">
                    {{Form::label('Score:', 'Score:')}}</br>
                    {{Form::text('Score', '',['class'=>'form-control','placeholder'=> 'Score'])}}
                </div>

                <div class="col-md-4">
                    {{Form::hidden('questions_id',$questions_id)}}</br>

                </div>
                </br>

                <div class="form-group">

                    <button type="submit" class="btn btn-primary">Save</button>
                    <!-- <input class="btn btn-primary" type="submit">Submit -->
                </div>


                @endsection