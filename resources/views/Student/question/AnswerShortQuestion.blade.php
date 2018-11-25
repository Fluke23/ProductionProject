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
     
            <img src="{{$q->img_url}} "width="100%" height="400%">

            <!-- <li class="list-group">Number: {{$key + 1}}</li> -->
           <!-- <li class="list-group">solution: {{$q->solution}}</li> -->
           <div class="col-md-12 mb-3">
                <strong>Question : </strong>{{$q->question}}
           </div>

           <div class="col-md-12 mb-3">
           <strong> Score : </strong> {{$q->score}}
           </div>
           
        
        @endforeach


        <hr>
    </div>
    <div class="container">
        <div class="col-md-12">
            <br>
            <form action="{{route('AnswerShortQuestion.file')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    {{Form::hidden ('1', '1',['id' => 'index'])}}

                </div>
                <div class="form-group">
                    <!-- {{Form::label('Answer', 'Answer')}} -->
                    <strong>Answer : </strong>
                    {{Form::text('Answer', '',['class'=>'form-control','placeholder'=> 'Enter Answer','id' => 'answer'])}}

                </div>
                <div class="form-group">
                    {{Form::hidden('questions_id',$questions_id,['id' => 'questions_id'])}}

                </div>

                <div class="form-group">
                    {{Form::hidden('quiz_id',$quiz_id)}}
                </div>


                <div class="text-right">
                <a class="btn btn-danger px-4 mr-1" href="{{url()->previous()}}">Cancel</a>
                    @if($q->questions_id != $questionMax)
                        <input class="btn btn-success px-4" type="submit">
                        <a href="#" onClick="return onClickHandler();" class="btn btn-primary px-4">                      
                            Next
                        </a>
                    @else
                        <input class="btn btn-success" type="submit px-4">
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