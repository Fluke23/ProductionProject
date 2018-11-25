@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-6">
            <h2>Review </h2>

        </div>


    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/subject')}}">Home</a></li>
        </ol>
    </nav>

    <div class="row">

        @foreach($questionReview as $q)
        @endforeach

        <div class="col-md-12">
            <h4>{{$q->title}}</h4>
        </div>

        <div class="col-md-12">
            <img src="{{$q->img_url}} " width="100%" height="60%">
        </div>

        {{-- Question --}}
        <div class="col-md-6">
            <strong> Question : </strong> {{$q->question}}
        </div>
        {{-- Question --}}

        {{-- Answer Date --}}
        <div class="col-md-6">
            <strong> Answer Date : </strong>{{$q->answer_date}}
        </div>
        {{-- Answer Date --}}

        {{-- Answer No: --}}
        <div class="col-md-6">
            <strong> Answer No : </strong>{{$q->number}}
        </div>
        {{-- Answer No: --}}

        {{-- Solution --}}
        <div class="col-md-6">
            <strong> Solution : </strong> {{$q->solution}}</li>
        </div>
        {{-- Solution --}}


        {{-- Std name --}}
        <div class="col-md-4">
            <strong> Student : </strong>{{$q->username}}</li>
        </div>
        {{-- Std name --}}


        {{-- Answer --}}
        <div class="col-md-12 mb-4 mt-4">
            {{-- {{Form::label('Answer:', 'Answer :')}}</br> --}}
            <strong> Answer : </strong>
            <textarea name="Answer:" cols="120" rows="5" id="Answer:" style="margin-top: 0px; margin-bottom: 0px; height: 170px;"
                class="form-control" readonly> {{$q->answer}}</textarea>
        </div>
        {{-- Answer --}}

        {{-- Score --}}
        <div class="col-md-3 mb-4">
            {{-- {{Form::label('Score:', 'Score :')}}</br> --}}
            <strong> Score : </strong>
            <textarea name="Answer:" cols="25" rows="10" id="Answer:" style="margin-top: 0px; margin-bottom: 0px; height: 50px;"
                class="form-control" readonly>   {{$q->Score}}</textarea>
        </div>
        {{-- Score --}}


        @foreach($questionReview as $q)
        <div class="col-md-12">
            {{-- {{Form::label('Comment:', 'Comment:')}}</br> --}}
            <strong> Comment : </strong>
            ( {{$q->usernames}} {{$q->created_at}} )
            <br>
            <p class="bg-light p-2 border border-primary rounded" name="Remark:" cols="120" rows="10" id="Answer:" readonly>
                {{$q->comment}}
            </p>
        </div>
        @endforeach
    </div>





    <div class="container mt-3">
        <div class="row">
            <form action="{{route('commentAnswer.file')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="col-md-12">
                    <strong> Comment : </strong>
                    <textarea class="form-control" name="Remark" cols="120" rows="5" id="Remark" style="margin-top: 0px; margin-bottom: 0px; height: 100px;">   </textarea>
                </div>

                <div class="col-md-4">
                    {{Form::hidden('questions_id',$questions_id)}}</br>
                </div>


                <div class="col-md-4">
                    {{Form::hidden('quiz_id',$quiz_id)}}</br>
                </div>

                <div class="col-md-12 text-right ">
                <a class="btn btn-dark px-5" href="{{URL::to('/Admin/question/'.$quiz_id)}}">Back</a>
                    <button type="submit" class="btn btn-primary px-5">Save</button>
                    <!-- <input class="btn btn-primary" type="submit">Submit -->
                   
                </div>

            </form>
        </div>
    </div>
    @endsection