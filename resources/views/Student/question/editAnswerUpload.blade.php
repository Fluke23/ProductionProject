@extends('layouts.student')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-6">
            <h2>Answer Question </h2>

        </div>


    </div>


    <div class="row">


        @foreach($answer as $key => $q)
        <ul class="list-group">

            <td> <img src="{{$q->img_url}} " "width=" 150" height="150"> </td><br>

            <!-- <li class="list-group">Number: {{$key + 1}}</li> -->
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
                    {{Form::label('Answer', 'Answer')}}<br>
                    @foreach($answer as $q)

                    <a name="Answer:" cols="120" rows="10" id="Answer:" 
                     style="margin-top: 0px; margin-bottom: 0px; height: 219px;" readonly href="{{$q->answer}}">   {{$q->answer}}</a><br>
                    
                    <input type="file" name="fileName" id="fileName" multiple>
                    @endforeach
                </div>



                <div class="form-group">
                    <button type="button" class="btn btn-danger">Cancel</button>

                    <input class="btn btn-success" type="submit">

                </div>

            </form>
        </div>
    </div>


    @endsection
