@extends('layouts.student')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-6">
            <h2>Answer Question </h2>

        </div>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/subject')}}">Home</a></li>
        </ol>
    </nav>


    <div class="row">


        @foreach($question4 as $key => $q)
        
            <!-- <li class="list-group">Number: {{$key + 1}}</li> -->
            <div class="col-md-12 my-3">
                <strong> Question : </strong> {{$q->question}}
            </div>
            <div class="col-md-12 mb-3">
                <strong> Score : </strong>{{$q->score}}
            </div>
           
        @endforeach
        <hr>
    </div>

    <div class="container">
        <div class="col-md-12">
            <br>
            <form action="{{route('AnswerStore')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                {{csrf_field()}}
                @csrf

                <div class="form-group">
                     {{Form::radio('answer','True',['id' => 'answer'])}}  
                True    
                    &nbsp;&nbsp;
                
                    {{Form::radio('answer','False',['id' => 'answer'])}}             
                False
                
                </div>



                <div class="form-group">
                    {{Form::hidden ('1', '1',['id' => 'index'])}}
                </div>

                <div class="form-group">
                    {{Form::hidden('questions_id',$questions_id, ['id' => 'questions_id'])}}
                </div>

                <div class="form-group">
                    {{Form::hidden('quiz_id',$quiz_id)}}
                </div>


                <div class="col-md-12 text-right"><hr>

                        <a class="btn btn-danger  px-4" href="{{url()->previous()}}">Cancel</a>
                    @if($q->questions_id != $questionMax)
                        <input class="btn btn-success px-4" type="submit">
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
                window.location = '{{ URL::to('Student/question/AnswerBlankQuestion/' . $next->questions_id . '/' . $next->quizs_id) }}' 
                + '?answer=' + answer 
                + '&input=' + inputIndex
                + '&questions_id=' + questionId
            }
        </script>
    @endif


    @endsection