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


    <div class="row">

{{--          
        <ul class="list-group">
            <img src="{{$q->img_url}} ">
            <a target="_blank" href="{{$q->img_url}}"> {{$q->img_url}} </a>
            <li class="list-group">Number: {{$key + 1}}</li>
            <!--<li class="list-group">solution: {{$q->solution}}</li>-->
            <li class="list-group">Question:{{$q->question}}</li>
            <li class="list-group">Score:{{$q->score}}</li>
        </ul>  --}}
        
        @foreach($question as $key => $q)
         <img src="{{$q->img_url}} ">
         <a target="_blank" href="{{$q->img_url}}"> {{$q->img_url}} </a>

        <div class="col-md-12 mb-3">
            <strong>Number : </strong> {{$key + 1}}
        </div>
        <div class="col-md-12 mb-3">
            <strong>Question : </strong> {{$q->question}}
        </div>
        <div class="col-md-12  mb-3">
            <strong>Score : </strong> {{$q->score}}
        </div>
         @endforeach


        <hr>
    </div>
    <div class="container">
        <div class="row">
            <br>
            <form action="{{route('AnswerUploadQuestion.file')}}" method="post" class="col-md-12" enctype="multipart/form-data">
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


                    <hr>
                <div class="form-group mt-3 text-right">
                    <a class="btn btn-danger px-4 " href="{{url()->previous()}}">Cancel</a>
                    @if($q->questions_id != $questionMax)
                        <input class="btn btn-success" type="submit">
                        <a href="#" onClick="return onClickHandler();" class="btn btn-primary px-4">                      
                            Next
                        </a>
                    @else
                        <input class="btn btn-success px-4" type="submit">
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