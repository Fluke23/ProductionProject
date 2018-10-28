@extends('layouts.lecturer')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-3">
            <h2>Quiz Manager</h2>
        </div>
        <div class="col-md-9">
            <a href="{{ URL::route('lec.addQuiz', ['subject_id'=>$subject_id]) }}" class="btn btn-success float-right"
                data-toggle="modal" data-target="#exampleModal">Add Quiz</a>

        </div>
    </div>
    <div class="row">
    <table class="table table-bordered">
            <tr>
                <th style="font-size: 1em;">Title</th>
                <th>Description</th>
                <th>Date</th>
                
                <th style="width:50px;">Group</th>
                <th style="width:50px;">Type</th>
                <th style="width:50px;">Status</th>
                <th style="width:50px;">Min</th>
                <th style="width:50px;">Max</th>
                <th style="width:50px;">AVG</th>
                <th></th>


            </tr>
           
            <tbody>
                @foreach($quizzes as $q)
                <tr>
                    <td style="font-size: 0.8em;">{{$q->title}}</td>
                    <td style="font-size: 0.8em;">{{$q->description}}</td>
                    <td style="font-size: 0.8em;">{{$q->quiz_date}}</td>
                    {{-- name is from group_name --}}
                    <td style="font-size: 0.8em;">{{$q->group_name}}</td>
                    <td style="font-size: 0.8em;">{{$q->type_name}}</td>
                    <td style="font-size: 0.8em;">{{$q->status_name}}</td>
                    <td style="font-size: 0.8em;">{{$quiz_min}}</td>
                    <td style="font-size: 0.8em;">{{$quiz_max}}</td>
                    <td style="font-size: 0.8em;">{{$quiz_avg}}</td>



                    <td>
                        <a href="{{URL::to('/Lecturer/question/'.$q->quizs_id)}}" class="btn btn-info ">View</a>
                        <a href="{{ URL::to('/lecturer/quiz/editQuiz/'.$q->quizs_id) }}" class="btn btn-warning ">Edit</a>
                        <a href="{{ URL::to('/Lecturer/quiz/deleteQuiz/'.$q->quizs_id.'/'.$q->subject_id)}}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>


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
                <div class="row">
                    <form action="{{URL::to('/Lecturer/quiz/saveQuiz/{subject_id?}')}}" method="post" id="addForm">
                        @csrf
                        {{-- title --}}
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('title') }}</label>

                            <div class="col-md-6">
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
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('description')
                                }}</label>

                            <div class="col-md-6">
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
                        <div class="form-group row">
                            <label for="quiz_date" class="col-md-4 col-form-label text-md-right">{{ __('quiz_date') }}</label>

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
                        <div class="form-group row">
                            <label for="subject_id" class="col-md-4 col-form-label text-md-right">{{ __('subject_id')
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

                        {{-- group_id --}}
                        <div class="form-group row">
                            <label for="groups_id" class="col-md-4 col-form-label text-md-right">{{ __('groups_id') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="groups_id" id="select1">
                                    @foreach($group as $g)
                                    <option value="{{$g->groups_id}}">{{$g->groups_id}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>


                        {{-- quiz type id --}}
                        <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label text-md-right">Quiz Type </label>

                            <div class="col-md-6">
                                <select class="form-control" name="quizs_types_id" id="select2">
                                    @foreach($quiz_type as $q)
                                    <option value="{{$q->quizs_types_id}}">{{$q->type_name}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>


                        {{-- quizs_status_id --}}

                        <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label text-md-right">Quiz Status </label>
                            <div class="col-md-6">
                                <select class="form-control" name="quizs_status_id" id="select3">
                                    @foreach($quiz_status as $qs)
                                    <option value="{{$qs->quizs_status_id}}">{{$qs->quizs_status_id}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal" class="form action" onclick='addForm()'>Add
                        quiz </button>
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

@endsection