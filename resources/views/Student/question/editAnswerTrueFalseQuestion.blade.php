@extends('layouts.student')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-6">
            <h2>Answer Question </h2>

        </div>


    </div>


    <div class="row">


        @foreach($answer2 as $a)
        @endforeach
        <ul class="list-group">

            <!-- <li class="list-group">Number: {{$a->number}}</li> -->
            <li class="list-group">Question:{{$a->question}} (Please Choose {{$a->answer_row}} Correct Answer)</li>
            <li class="list-group">Score:{{$a->score}}</li>



        </ul>

        <hr>
    </div>
    <div class="container">
        <div class="row">
            <br>
            <form action="{{route('editAnswerTrueFalse.file', $answer_id)}}" method="post" class="form-horizontal"
                enctype="multipart/form-data">
                {{csrf_field()}}


                <div class="form-group">
                    True
                    {{Form::radio('answer','True',['id' => 'answer'])}}
                    False
                    {{Form::radio('answer','False',['id' => 'answer'])}}
                </div>

                <div class="form-group">
                    {{Form::hidden ('1', '1',['id' => 'index'])}}
                </div>

                <div class="form-group">
                    {{Form::hidden('answer_id',$answer_id)}}
                </div>

                <div class="form-group">
                    <button type="button" class="btn btn-danger">Cancel</button>
                    <input class="btn btn-success" type="submit">
                </div>
        </div>
        </form>
    </div>
</div>
@endsection