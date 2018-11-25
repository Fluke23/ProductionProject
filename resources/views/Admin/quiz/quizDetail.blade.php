@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-3">
            <h2>Quiz Manager</h2>
        </div>
        <div class="col-md-9">
            <a href="{{ URL::route('addQuiz', ['subject_id'=>$subject_id]) }}" class="btn btn-success float-right"
                data-toggle="modal" data-target="#exampleModal">Add Quiz</a>
        </div>
    </div>
    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/subject')}}">Home</a></li>

            <li class="breadcrumb-item"><a href="{{URL::to('/Admin/quiz/'.$subject_id)}}">{{$subject_id}}</a></li>
        </ol>
    </nav>
    {{-- Breadcrumb --}}

    {{-- Nav-tab --}}
    <ul class="nav nav-tabs mb-3">


        @if(Request::is('Admin/quiz/'.$subject_id) == 'Admin/quiz/'.$subject_id)
        <li class="nav-item">
            <a class="nav-link active" href="{{URL::to('/Admin/quiz/'.$subject_id)}}">All</a>
        </li>
        @foreach ($quiz_type as $qt)
        <li class="nav-item">
            <a class="nav-link " href="{{URL::to('/Admin/quiz/'.$subject_id.'/'.$qt->quizs_types_id)}}">{{$qt->type_name}}</a>
        </li>
        @endforeach
        @else
        <li class="nav-item">
            <a class="nav-link " href="{{URL::to('/Admin/quiz/'.$subject_id)}}">All</a>
        </li>
        @foreach ($quiz_type as $qt)
        @if(Request::is('Admin/quiz/'.$subject_id.'/'.$qt->quizs_types_id) ==
        'Admin/quiz/'.$subject_id.'/'.$qt->quizs_types_id)
        <li class="nav-item">
            <a class="nav-link active" href="{{URL::to('/Admin/quiz/'.$subject_id.'/'.$qt->quizs_types_id)}}">{{$qt->type_name}}</a>
        </li>
        @else
        <li class="nav-item">
            <a class="nav-link " href="{{URL::to('/Admin/quiz/'.$subject_id.'/'.$qt->quizs_types_id)}}">{{$qt->type_name}}</a>
        </li>
        @endif
        @endforeach
        @endif
    </ul>
    {{-- Nav-tab --}}

    <div class="row">
        <div class="table col-md-12">
            <table id="table">
                <thead>
                    <tr>
                        <th width="10px;">Title</th>
                        <th width="10px;">Description</th>
                        <th width="2px;">Date</th>
                        <th width="1px;">Group</th>
                        <th width="1px;">Type</th>
                        <th width="1px;">Status</th>
                        <th width="1px;">Min</th>
                        <th width="1px;">Max</th>
                        <th width="1px;">AVG</th>
                        <th width="20px">Option</th>
                    </tr>
                </thead>


                <tbody>
                    @foreach($quizzes as $q)
                    <tr>
                        <td style="font-size: 0.8em;"><a href="{{URL::to('/Admin/question/'.$q->quizs_id.'/'.$q->subject_id)}}">{{$q->title}}
                            </a></td>
                        <td style="font-size: 0.8em;">{{$q->description}}</td>
                        <td style="font-size: 0.8em;">{{$q->quiz_date}}</td>
                        {{-- name is from group_name --}}
                        <td style="font-size: 0.8em;">{{$q->student_group}}</td>
                        <td style="font-size: 0.8em;">{{$q->type_name}}</td>
                        <td style="font-size: 0.8em;">{{$q->status_name}}</td>
                        <td style="font-size: 0.8em;">{{$q->min}}</td>
                        <td style="font-size: 0.8em;">{{$q->max}}</td>
                        <td style="font-size: 0.8em;">{{$q->avg}}</td>


                        <td>
                            <a href="{{URL::to('/Admin/question/'.$q->quizs_id.'/'.$q->subject_id)}}" class="btn btn-info btn-sm mb-1">View</a>
                            <a href="{{URL::to('/Admin/showQuizScore/ShowUserScore/'.$q->quizs_id)}}" class="btn btn-primary btn-sm mb-1">Score</a>

                            <a href="{{ URL::to('/Admin/quiz/editQuiz/'.$q->quizs_id) }}" class="btn btn-warning btn-sm mb-1">Edit</a>
                            <a href="{{ URL::to('/Admin/quiz/deleteQuiz/'.$q->quizs_id.'/'.$q->subject_id)}}" class="btn btn-danger btn-sm mb-1"
                                onclick="return ConfirmDelete();">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
        <hr>
    </div>


</div>

<!-- add quiz -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Quiz</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div>
                    <form action="{{URL::to('/Admin/quiz/saveQuiz/{subject_id?}')}}" method="post" id="addForm">
                        @csrf
                        {{-- title --}}
                        <div class="form-group ">
                            <label for="title" class="col-md-4 col-form-label text-md-left">{{ __('Quiz Title :') }}</label>

                            <div class="col-md-12">
                                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                    name="title" value="{{ old('title') }}" required autofocus>

                                @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        {{-- description --}}
                        <div class="form-group">
                            <label for="description" class="col-md-6 col-form-label text-md-left">{{ __('Quiz
                                Description : ')
                                }}</label>

                            <div class="col-md-12">
                                <input id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                    name="description" value="{{ old('description') }}" required autofocus>

                                @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        {{-- Date --}}
                        <div class="form-group ">
                            <label for="quiz_date" class="col-md-4 col-form-label text-md-left">{{ __('Quiz Date : ')
                                }}</label>

                            <div class="col-md-6">
                                <input id="quiz_date" type="date" class="form-control{{ $errors->has('quiz_date') ? ' is-invalid' : '' }}"
                                    name="quiz_date" value="{{ old('quiz_date') }}" required autofocus>

                                @if ($errors->has('quiz_date'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('quiz_date') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        {{-- subject_id --}}
                        <div class="form-group ">
                            <label for="subject_id" class="col-md-4 col-form-label text-md-left">{{ __('Subject ID : ')
                                }}</label>

                            <div class="col-md-6">
                                <input id="subject_id" type="text" class="form-control{{ $errors->has('subject_id') ? ' is-invalid' : '' }}"
                                    name="subject_id" value="{{ $subject_id }}" required readonly autofocus>

                                @if ($errors->has('subject_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('subject_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                </div>

                {{-- --}}
                <div class="form-group ">
                    <label for="student_group" class="col-md-4 col-form-label text-md-left">{{ __('Student Group : ')
                        }}</label>

                    <div class="col-md-6">
                        <select class="form-control" name="student_group" id="select1">
                            <div class="col-md-6">
                                @foreach($quiz_group as $g)
                                <option value="{{$g->student_group_name}}">{{$g->student_group_name}}</option>
                                @endforeach
                        </select>

                    </div>
                </div>
                {{-- --}}

                <!--  <div class="form-group row">
                            <label for="remark" class="col-md-4 col-form-label text-md-left">{{
                                __('Group') }}</label>

                            <div class="col-md-6">
                                {{Form::select('groups_id', array('G1'=>'G1' ,
                                'G2'=>'G2'))}}
                                @if ($errors->has('Group'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('Group') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div> -->


                {{-- quiz type id --}}
                <div class="form-group ">
                    <label for="" class="col-md-4 col-form-label text-md-left">Quiz Type : </label>

                    <div class="col-md-12">
                        <select class="form-control" name="quizs_types_id" id="select2">
                            @foreach($quiz_type as $q)
                            <option value="{{$q->quizs_types_id}}">{{$q->type_name}}</option>
                            @endforeach
                        </select>

                    </div>
                </div>


                {{-- quizs_status_id --}}

                <div class="form-group ">
                    <label for="" class="col-md-4 col-form-label text-md-left">Quiz Status : </label>
                    <div class="col-md-12">
                        <select class="form-control" name="quizs_status_id" id="select3">
                            @foreach($quiz_status as $qs)
                            <option value="{{$qs->quizs_status_id}}">{{$qs->quizs_status_id}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer mt-4">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" data-dismiss="modal" class="form action" onclick='addForm()'>Add
                    Quiz </button>
            </div>

        </div>
    </div>

</div>
</div>
</form>

<script>
    function addForm() {
        document.getElementById('addForm').submit();
    }

</script>
{{-- JavaScript --}}
<script>
    function ConfirmDelete() {
        var x = confirm("Are you sure you want to delete?");
        if (x)
            return true;
        else
            return false;
    }

</script>
{{-- JavaScript --}}

@endsection
