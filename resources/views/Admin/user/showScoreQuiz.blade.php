@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-3">
            <h2>Show Score Quiz</h2>
        </div>
        <div class="col-md-9">
            {{--  <a href="{{ URL::route('addQuiz', ['subject_id'=>$subject_id]) }}" class="btn btn-success float-right"
                data-toggle="modal" data-target="#exampleModal">Add Quiz</a>  --}}
        </div>
    </div>
    {{--  Breadcrumb  --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/subject')}}">Home</a></li>
            
            {{--  <li class="breadcrumb-item active"><a href="{{route('showQuizScore')}}">Show Quiz</a></li>  --}}
        </ol>
    </nav>
    {{--  Breadcrumb  --}}
    

    <div class="row">
        <table class="table table-bordered">
            <tr>
                <th width="12%">Title</th>
                <th width="14%">Description</th>
                <th width="3%">Date</th>
                
                <th width="1%">Group</th>
                <th width="5%" >Type</th>
                <th width="1%">Status</th>
                <th width="2%">Min</th>
                <th width="2%">Max</th>
                <th width="1%">AVG</th>
                <th width="1%"></th>


            </tr>
           
            <tbody>
                @foreach($quizzes as $q)
                <tr>
                    <td style="font-size: 0.8em;">{{$q->title}} </td>
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
                        <a href="{{URL::to('/Admin/showQuizScore/ShowUserScore/'.$q->quizs_id)}}" class="btn btn-info ">User Score</a>
                       
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>


        <hr>
        {{ $quizzes}}
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
                    <form action="{{URL::to('/Admin/quiz/saveQuiz/{subject_id?}')}}" method="post" id="addForm">
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
                            <label for="subject_id" class="col-md-4 col-form-label text-md-right">{{ __('subject')
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

                        <!--  {{-- group_id --}}
                        <div class="form-group row">
                            <label for="groups_id" class="col-md-4 col-form-label text-md-right">{{ __('groups') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="groups_id" id="select1">
                                <div class="col-md-6">
                                    @foreach($group as $g)
                                    <option value="{{$g->groups_id}}">{{$g->groups_id}}</option>
                                    @endforeach 
                                </select>

                            </div>
                        </div> -->

                        {{-- student_group_id --}}
                         <div class="form-group row">
                            <label for="Student_group" class="col-md-4 col-form-label text-md-right">{{ __('group') }}</label>

                            <div class="col-md-6">

                                <div class="col-md-6">
                                    {{Form::select('Student_group', array('G1'=>'G1' ,
                                    'G2'=>'G2'))}}
                                    @if ($errors->has('Student_group'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('Student_group') }}</strong>
                                                </span>
                                                @endif
                                </div>
                            </div>
                        </div>  

                       <!--  <div class="form-group row">
                            <label for="remark" class="col-md-4 col-form-label text-md-right">{{
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
                        <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label text-md-right"> Type </label>

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
                            <label for="" class="col-md-4 col-form-label text-md-right">Status </label>
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
