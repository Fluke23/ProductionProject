@extends('layouts.student')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-6">
            <h2>Answer Question </h2>

        </div>
    </div>

       {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>

            {{--  <li class="breadcrumb-item"><a href="{{URL::to('/Admin/quiz/'.$subject_id)}}">{{$subject_id}}</a></li>  --}}
        </ol>
    </nav>
    {{-- Breadcrumb --}}


    
        <div class="row">
            @foreach($question as $key => $q)
            
                <img src="{{$q->img_url}} "width="100%" height="400%">

                {{--  Number  --}}
                <div class="col-md-12 mb-3">
                     <strong> Number : </strong>  {{$key + 1}}
                </div>
                {{--  Number  --}}

                {{--  Question  --}}
                <div class="col-md-12 mb-3">
                 <strong>  Question :</strong>  {{$q->question}}
                </div>
                {{--  Question  --}}

                {{--  Solution  --}}
                <div class="col-md-12 mb-3">
                   <strong> Solution :</strong>  {{$q->solution}} 
                </div>
                {{--  Solution  --}}
                
                {{--  Score  --}}
                <div class="col-md-12 mb-3">
                 <strong>Score :</strong>  {{$q->score}}
                </div> 
                {{--  Score  --}}

            @endforeach
            <hr>
        </div>



    
        <div class="col-md-12">
            <form action="{{route('AnswerBlankQuestion.file')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                {{csrf_field()}}
                    
                        {{--  Hidden  --}}
                        <div class="form-group">
                            {{Form::hidden ('1', '1', ['id' => 'index'])}}
                        </div>
                         {{--  Hidden  --}}
                        
                        <div class="col-md-12">
                            <strong> Answer : </strong>
                            {{Form::textarea('Answer', '',['class'=>'form-control','placeholder'=> 'Enter Answer', 'id' => 'answer'])}}
                        </div>


                        <div class="form-group">
                            {{Form::hidden('questions_id',$questions_id, ['id' => 'questions_id'])}}

                        </div>
                        <div class="form-group">
                            {{Form::hidden('quiz_id',$quiz_id)}}
                        </div>
                        

                        <div class="text-right">
                            <a class="btn btn-dark px-4 mr-1" href="{{url()->previous()}}">Back</a>
                            @if($q->questions_id != $questionMax)
                                <input class="btn btn-success px-4 mr-1" type="submit">
                                <a href="#" onClick="return onClickHandler();" class="btn btn-primary px-4">                      
                                    Next
                                </a>
                            @else
                                <input class="btn btn-success px-4" type="submit">
                            @endif 
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