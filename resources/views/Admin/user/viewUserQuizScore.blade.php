@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-3">
            <h2>Each Quiz Score</h2>
        </div>
        <div class="col-md-9">
            {{-- <a href="{{ URL::route('addQuiz', ['subject_id'=>$subject_id]) }}" class="btn btn-success float-right"
                data-toggle="modal" data-target="#exampleModal">Add Quiz</a> --}}
        </div>
    </div>
     {{-- breadcrumb --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/userManager')}}">User Manager</a></li>
            <li class="breadcrumb-item">
           @foreach ($name as $n)
               {{ $n->username }}
               {{ $n->firstname }}
                {{ $n->lastname }}
           @endforeach
            </li>
              <li class="breadcrumb-item ">
                    Each Quiz Score
            </li>
        </ol>
    </nav>
    {{-- breadcrumb --}}

   

    <div class="row">
        <div class="col-md-12">
            <table id="table" class="table">
                <thead>
                    <tr>
                        <th width="10px;">Title</th>
                        <th width="10px;">Description</th>
                        <th width="2px;">Date</th>
                        <th width="1px;">Group</th>
                        <th width="1px;">Type</th>
                        <th width="1px;">Score</th>
                        <th width="1px;">Min</th>
                        <th width="1px;">Max</th>
                        <th width="1px;">AVG</th>
                        {{-- <th width="20px">Option</th> --}}
                    </tr>
                </thead>


                <tbody>
                    @foreach($quizzes as $q)
                    <tr>
                        <td style="font-size: 0.8em;"><a href="{{URL::to('/Admin/question/'.$q->quizs_id)}}">{{$q->title}}
                            </a></td>
                        <td style="font-size: 0.8em;">{{$q->description}}</td>
                        <td style="font-size: 0.8em;">{{$q->quiz_date}}</td>
                        {{-- name is from group_name --}}
                        <td style="font-size: 0.8em;">{{$q->student_group}}</td>
                        <td style="font-size: 0.8em;">{{$q->type_name}}</td>
                        <td style="font-size: 0.8em;">{{$q->user_score}}</td>
                        <td style="font-size: 0.8em;">{{$q->min}}</td>
                        <td style="font-size: 0.8em;">{{$q->max}}</td>
                        <td style="font-size: 0.8em;">{{$q->avg}}</td>


                        {{-- <td>
                            <a href="{{URL::to('/Admin/question/'.$q->quizs_id)}}" class="btn btn-info btn-sm mb-1">View</a>
                            <a href="{{URL::to('/Admin/showQuizScore/ShowUserScore/'.$q->quizs_id)}}" class="btn btn-primary btn-sm mb-1">Score</a>

                            <a href="{{ URL::to('/Admin/quiz/editQuiz/'.$q->quizs_id) }}" class="btn btn-warning btn-sm mb-1">Edit</a>
                            <a href="{{ URL::to('/Admin/quiz/deleteQuiz/'.$q->quizs_id.'/'.$q->subject_id)}}" class="btn btn-danger btn-sm mb-1"
                                onclick="return ConfirmDelete();">Delete</a>
                        </td> --}}
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
        <hr>
    </div>


</div>




<script>
    function addForm() {
        document.getElementById('addForm').submit();
    }

</script>
{{--  JavaScript  --}}
    <script>
        function ConfirmDelete()
        {
        var x = confirm("Are you sure you want to delete?");
        if (x)
            return true;
        else
            return false;
        }
    </script>  
{{--  JavaScript  --}}

@endsection
