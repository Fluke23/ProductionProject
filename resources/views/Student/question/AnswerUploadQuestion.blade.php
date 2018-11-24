@extends('layouts.student')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-6">
            <h2>Answer Question </h2>

        </div>


    </div>


    <div class="row">


        @foreach($question as $key => $q)
        <ul class="list-group">
            <img src="{{$q->img_url}} ">
            <a target="_blank" href="{{$q->img_url}}"> {{$q->img_url}} </a>
            <!-- <li class="list-group">Number: {{$key + 1}}</li> -->
            <!--<li class="list-group">solution: {{$q->solution}}</li>-->
            <li class="list-group">Question:{{$q->question}}</li>
            <li class="list-group">Score:{{$q->score}}</li>



        </ul>
        @endforeach
        <hr>
    </div>
    <div class="container">
        <div class="row">
            <br>
            <form action="{{route('AnswerUploadQuestion.file')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    {{Form::hidden ('1', '1',['id' => 'index'])}}

                </div>
                <input type="file" name="fileName" id="fileName" multiple >
                <div class="form-group">
                    {{Form::hidden('Upload', 'Upload')}}

                </div>

                <div class="form-group">
                    {{Form::hidden('questions_id',$questions_id,['id' => 'questions_id'])}}
                </div>

                <div class="form-group">
                    {{Form::hidden('quiz_id',$quiz_id)}}
                </div>



                <div class="form-group">
                    <button type="button" class="btn btn-danger">Cencel</button>
                    @if($q->questions_id != $questionMax)
                        <input class="btn btn-success" type="submit">
                        <a href="#" onClick="return onClickHandler();" class="btn btn-primary">                      
                            Next
                        </a>
                    @else
                        <input class="btn btn-success" type="submit">
                    @endif 
                </div>
                </div>
            </form>
        </div>
    </div>

@if($next)
    <script>
        const onClickHandler = () => {
            const answer = document.getElementById('answer').value
            const inputIndex = document.getElementById('index').value
            const questionId = document.getElementById('questions_id').value
            window.location = '{{ URL::to('Student/question/AnswerBlankQuestion/' .$next->questions_id . '/' .$next->quizs_id) }}' 
            + '?answer=' + answer 
            + '&input=' + inputIndex
            + '&questions_id=' + questionId
        }
    </script>
@endif

    @endsection