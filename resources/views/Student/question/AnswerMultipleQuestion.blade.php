@extends('layouts.student')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-6">
            <h2>Answer Question </h2>

        </div>
    </div>

 
  {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>

            {{--  <li class="breadcrumb-item"><a href="{{URL::to('/Admin/quiz/'.$subject_id)}}">{{$subject_id}}</a></li>  --}}
        </ol>
    </nav>
    {{-- Breadcrumb --}}

    <div class="row mt-3">
        @foreach($question4 as $q)
      

        {{-- Number  --}}
        <div class="col-md-12 mb-3">
            <strong>Number : </strong>{{$q->number}}
        </div>
        {{-- Number  --}}

        {{--  Question  --}}
        <div class="col-md-12 mb-3">
            <strong>Question : </strong> {{$q->question}} (Please Choose {{$q->answer_row}} Correct Answer)
        </div>
        {{--  Question  --}}

        {{--  Score  --}}
        <div class="col-md-12 mb-3">
            <strong>Score : </strong> {{$q->score}}
        </div>

        {{--   Score --}}
        <div class="col-md-12"></div>
        @endforeach
        <hr>
    </div>

 
        <div class="row">
            <br>
            <form action="{{route('AnswerMultipleQuestion.file')}}" method="post" class="col-md-12" enctype="multipart/form-data">
                {{csrf_field()}}
                            @foreach ($question5 as $key => $q2)
                                @if($q2->answer_row > 1)
                                    <div class="form-group">
                                        {{Form::checkbox('answer',$q2->choice,['id' => 'answer','class'=>'w-30'])}}
                                       &nbsp; &nbsp; <span class="checkboxtext">{{$q2->choice}}</span> 
                                        {{Form::hidden ('choice_id', $q2->choice_id)}}
                                    </div>
                                @else
                                <div class="form-group">
                                    {{$q2->choice}}
                                    {{Form::radio('answer',$q2->choice,['id' => 'answer'])}}
                                    {{Form::hidden ('choice_id', $q2->choice_id)}}
                                </div>
                                @endif
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

                            <hr>
                            <div class="col-md-12 text-right">
                            <a class="btn btn-dark px-4 mr-1" href="{{url()->previous()}}">Back</a>
                                @if($q2->questions_id != $questionMax)
                                    <input class="btn btn-success px-4" type="submit">
                                    <a href="#" onClick="return onClickHandler();" class="btn btn-primary px-4"> 
                                        Next
                                    </a>
                                @else
                                    <input class="btn btn-success px-4" type="submit">
                                @endif 
                            </div>
                               </form>
                    </div>   
                        {{--  row  --}}

    </div>
    {{--  Container  --}}

@if($next)
    <!-- <script>
        const onClickHandler = () => {
            const answerInput = Array.from(document.querySelectorAll("input[name^='answer[']"))
            const answerString = answerInput
                .filter(answer => answer.checked)
                .map(answer => answer.value)
                .reduce((result, answer, index) => {
                    result += `&answer[${index}]=${answer}`
                    return result
                }, '')
            const inputIndex = document.getElementById('index').value
            const questionId = document.getElementById('questions_id').value
            const location = '{{ URL::to('Student/question/AnswerBlankQuestion/' . $next->questions_id . '/' . $next->quizs_id) }}' 
            + '?input=' + inputIndex
            + answerString
            + '&questions_id=' + questionId
            window.location = location
        }
    </script> -->
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