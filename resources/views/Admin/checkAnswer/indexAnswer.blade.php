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
        <table class="table table-bordered">
            <tr>
                <th style="font-size: 1em;">Number</th>
                <th style="font-size: 1em;"> Username</th>
                <th>Answer</th>
                <th style="width:50px;">Score</th>
                <th style="width:50px;">Type</th>
                <th></th>
                

            </tr>

            <tbody>
                    
            
            @foreach($question as $q)
            @endforeach
                    <div class="col-md-6">
                        <h4>{{$q->title}}</h4>
                    <li class="list-group">{{$q->question}}</li>

                     </div></br>
                     @foreach($question as $key => $q)
                <tr>
                        <td>{{ $key + 1 }}</td>
                        <td style="font-size: 0.8em;">{{$q->username}}</td>
                        <td style="font-size: 0.8em;">{{$q->answer}}</td>
                        <td style="font-size: 0.8em;">{{$q->Score}}</td>
                        <td style="font-size: 0.8em;">{{$q->questions_types_id}}</td>
                    

                        <td>
                        @if($q->questions_types_id == 'Multiple' || $q->questions_types_id  == 'TrueFalse')
                        <a href="{{URL::to('/Admin/checkMultipleAnswer/reviewAnswer/'.$q->questions_id)}}" class="btn btn-info ">Review</a>
                        @else
                        <a href="{{URL::to('/Admin/checkAnswer/reviewAnswer/'.$q->answer_id)}}" class="btn btn-info ">Review</a>
                        @endif

                    </td>
                        @endforeach
                </tr>
                    
    

    @endsection