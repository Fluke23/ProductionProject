@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-3">
            <h2 >Edit Quiz</h2>
            </div>
            <div class="col-md-9">
            
                </div>   
    </div>

    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/subject')}}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit Quiz</li>
            </ol>
          </nav>
          

    <div class="card">
        <div class="card-body">
             <form action="{{URL::to('Admin/quiz/updateQuiz')}}" method="post">
        @csrf

        {{-- title --}}
        <div class="form-group row">
            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Quiz Title') }}</label>

            <div class="col-md-6">
                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ $quiz->title}}" required autofocus>

                @if ($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        {{-- description --}}
        <div class="form-group row">
            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Quiz Description') }}</label>

            <div class="col-md-6">
            <input id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{$quiz->description}}" required autofocus>

                @if ($errors->has('description'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>
        </div>


      {{-- Date --}}
        <div class="form-group row">
            <label for="quiz_date" class="col-md-4 col-form-label text-md-right">{{ __('Quiz Date') }}</label>

            <div class="col-md-6">
            <input id="quiz_date" type="date" class="form-control{{ $errors->has('quiz_date') ? ' is-invalid' : '' }}" name="quiz_date" value="{{ date('Y-m-d',strtotime($quiz->quiz_date)) }}" required autofocus>

                @if ($errors->has('quiz_date'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('quiz_date') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        {{-- subject_id --}}
        <div class="form-group row">
            <label for="subject_id" class="col-md-4 col-form-label text-md-right">{{ __('Subject ID') }}</label>

            <div class="col-md-6">
            <input id="subject_id" type="text" class="form-control{{ $errors->has('subject_id') ? ' is-invalid' : '' }}" name="subject_id" value="{{$quiz->subject_id}}" required readonly autofocus>

                @if ($errors->has('subject_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('subject_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>

         {{-- student_group_id --}}                        
                        <div class="form-group row">
                            <label for="student_group" class="col-md-4 col-form-label text-md-right">{{ __('Student Group') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="student_group" id="select1">
                                <div class="col-md-6">
                                    @foreach($quiz_group as $g)
                                    <option value="{{$g->student_group_name}}">{{$g->student_group_name}}</option>
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

                <input type="hidden" name="quiz_id" value="{{$quiz->quizs_id}}">

            <div class="col-md-12 text-center">
                {{--  <button type="reset" class="btn btn-danger mr-2">Cancel</button>  --}}
                <a class="btn btn-danger mr-2" href="{{url()->previous()}}">Cancel</a>
                <button type="submit" class="btn btn-success px-4">Save</button>
            </div>
        </form>
        </div>
        {{--  card body  --}}
   
    </div>
    {{-- card   --}}


</div>
@endsection