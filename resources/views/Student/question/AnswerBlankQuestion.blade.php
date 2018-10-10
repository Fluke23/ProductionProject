@extends('layouts.student')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-6">
            <h2>Answer Question </h2>

        </div>


    </div>


    <div class="row">


        @foreach($question as $q)
        <ul class="list-group">
            <img src="{{$q->img_url}} ">

            <li class="list-group">Number: {{$q->number}}</li>
            <li class="list-group">solution: {{$q->solution}}</li>
            <li class="list-group">Question:{{$q->question}}</li>
            <li class="list-group">Score:{{$q->score}}</li>



        </ul>
        @endforeach
        <hr>
    </div>
    <div class="container">
        <div class="row">
            <br>
            <form action="{{route('AnswerBlankQuestion.file')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    {{Form::hidden ('1', '1')}}

                </div>
                <div class="form-group">
                    {{Form::label('Answer', 'Answer')}}
                    {{Form::textarea('Answer', '',['class'=>'form-control','placeholder'=> 'Enter Answer'])}}

                </div>
                <div class="form-group">
                    {{Form::hidden('questions_id',$questions_id)}}

                </div>
                <div class="form-group">
                    {{Form::hidden('quiz_id',$quiz_id)}}
                </div>


                <div class="form-group">
                    <button type="button" class="btn btn-danger">Cencel</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                    <!-- <input class="btn btn-primary" type="submit">Submit -->
                </div>
                
            </form>
        </div>
    </div>

    @endsection