@extends('layouts.student')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-6">
            <h2>Answer Question </h2>

        </div>


    </div>


    <div class="row">


        @foreach($question4 as $q)
        <ul class="list-group">


            <li class="list-group">Number: {{$q->number}}</li>
            <li class="list-group">Question:{{$q->question}}</li>
            <li class="list-group">Score:{{$q->score}}</li>



        </ul>
        @endforeach
        <hr>
    </div>

    <div class="container">
        <div class="row">
            <br>
            <form action="{{route('AnswerStore')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                {{csrf_field()}}
                @csrf

                @foreach($question5 as $q2)
                <div class="form-group">
                    {{$q2->choice}}
                    {{Form::radio('answer',$q2->choice,'',['id' => 'answer'])}}
                    {{Form::hidden ('choice_id', $q2->choice_id)}}
                </div>
                @endforeach


                <div class="form-group">
                    {{Form::hidden ('1', '1',['id' => 'index'])}}
                </div>

                <div class="form-group">
                    {{Form::hidden('questions_id',$questions_id, ['id' => 'questions_id'])}}
                </div>

                <div class="form-group">
                    {{Form::hidden('quiz_id',$quiz_id)}}
                </div>


                <div class="form-group">
                    <button type="button" class="btn btn-danger">Cancel</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a href="#" onClick="return onClickHandler();" class="btn btn-primary">
                        Next
                    </a>

                </div>

            </form>
        </div>
    </div>



    <script>
        const onClickHandler = () => {
            const answer = document.getElementById('answer').value
            const inputIndex = document.getElementById('index').value
            const questionId = document.getElementById('questions_id').value
            window.location = '{{ URL::to('Student/question/AnswerBlankQuestion/' . $next->questions_id . '/' . $next->quizs_id) }}' 
            + '?answer=' + answer 
            + '&input=' + inputIndex
            + '&questions_id=' + questionId
        }
    </script>


    @endsection