@extends('layouts.lecturer')
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
          

    <div class="row">
    <form action="{{URL::to('/Lecturer/quiz/updateQuiz')}}" method="post">
        @csrf

        {{-- title --}}
        <div class="form-group row">
            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('title') }}</label>

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
            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('description') }}</label>

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
            <label for="quiz_date" class="col-md-4 col-form-label text-md-right">{{ __('quiz_date') }}</label>

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
            <label for="subject_id" class="col-md-4 col-form-label text-md-right">{{ __('subject_id') }}</label>

            <div class="col-md-6">
            <input id="subject_id" type="text" class="form-control{{ $errors->has('subject_id') ? ' is-invalid' : '' }}" name="subject_id" value="{{$quiz->subject_id}}" required autofocus>

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
            <input id="groups_id" type="text" class="form-control{{ $errors->has('groups_id') ? ' is-invalid' : '' }}" name="groups_id" value="{{$quiz->groups_id}}" required autofocus>

                @if ($errors->has('groups_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('groups_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        {{-- quizs_types_id --}}
        <div class="form-group row">
            <label for="quizs_types_id" class="col-md-4 col-form-label text-md-right">{{ __('quizs_types_id') }}</label>

            <div class="col-md-6">
            <input id="quizs_types_id" type="text" class="form-control{{ $errors->has('quizs_types_id') ? ' is-invalid' : '' }}" name="quizs_types_id" value="{{$quiz->quizs_types_id}}" required autofocus>

                @if ($errors->has('quizs_types_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('quizs_types_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        {{-- quizs_status_id --}}
        <div class="form-group row">
            <label for="quizs_status_id" class="col-md-4 col-form-label text-md-right">{{ __('quizs_status_id') }}</label>

            <div class="col-md-6">
            <input id="quizs_status_id" type="text" class="form-control{{ $errors->has('quizs_status_id') ? ' is-invalid' : '' }}" name="quizs_status_id" value="{{$quiz->quizs_status_id}}" required autofocus>

                @if ($errors->has('quizs_status_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('quizs_status_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <input type="hidden" name="quiz_id" value="{{ $quiz->quizs_id}}">


        <button type="reset" class="btn btn-danger">ยกเลิก</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
        
        </form>
    </div>


</div>
@endsection
