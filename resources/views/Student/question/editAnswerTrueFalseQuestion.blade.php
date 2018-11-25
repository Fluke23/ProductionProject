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


        @foreach($answer2 as $a)
            @endforeach
                          <!-- <li class="list-group">Number: {{$a->number}}</li> -->     
        <div class="col-md-12 my-3">
            <strong>Question : </strong> {{$a->question}} (Please Choose {{$a->answer_row}} Correct Answer)
        </div>
           <div class="col-md-12 mb-3">
                <strong> Score : </strong>   {{$a->score}}
           </div>

        <hr>
    </div>
    <div class="container">
        <div class="col-md-12">
            <br>
            <form action="{{route('editAnswerTrueFalse.file', $answer_id)}}" method="post" class="form-horizontal"
                enctype="multipart/form-data">
                {{csrf_field()}}


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
                    {{Form::hidden('answer_id',$answer_id)}}
                </div>

                <div class="col-md-12 text-right"><hr>
                         <a class="btn btn-dark  px-4" href="{{url()->previous()}}">Back</a>
                    <input class="btn btn-success px-4" type="submit">
                </div>
        </div>
        </form>
    </div>
</div>
@endsection