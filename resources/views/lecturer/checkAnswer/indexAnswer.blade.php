@extends('layouts.lecturer')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-6">
            <h2>Review </h2>

        </div>


    </div>


    <div class="row">
        <table class="table table-bordered">
            <tr>
                <th style="font-size: 1em;"> Username</th>
                <th>Answer</th>
                <th style="width:50px;">Score</th>
                <th style="width:50px;">Type</th>
                <th></th>
                

            </tr>

            <tbody>
                    @foreach($question as $q)
               
               
                    <div class="col-md-6">
                        <h4>{{$q->title}}</h4>
                    <li class="list-group">{{$q->question}}</li>

                     </div></br>
                <tr>
                        <td style="font-size: 0.8em;">{{$q->username}}</td>
                        <td style="font-size: 0.8em;">{{$q->answer}}</td>
                        <td style="font-size: 0.8em;">{{$q->score}}</td>
                        <td style="font-size: 0.8em;">{{$q->questions_types_id}}</td>
                    

                        <td >
                        <a href="{{URL::to('/Admin/checkAnswer/reviewAnswer/'.$q->questions_id)}}" class="btn btn-info ">Review</a>
                        
                        </td>
                </tr>
                     @endforeach
    

    @endsection