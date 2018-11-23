@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-3">
            <h2 >Edit Question</h2>
            </div>
            <div class="col-md-9">
            
                </div>   
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/subject')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/quiz/'.$subject[0]->subject_id)}}">Quizmanager</a></li>

            <li class="breadcrumb-item"><a href="{{URL::to('/Admin/question/'.$quizs_id)}}">{{$quiz[0]->title}}</a></li>

        </ol>
    </nav>
          

    <div class="row">
    <form action="{{URL::to('quiz/updateQuestion')}}" method="post">
        @csrf

       
       {{-- Question number --}}
        <div class="form-group row">
            <label for="number" class="col-md-4 col-form-label text-md-right">{{ __('number') }}</label>

            <div class="col-md-6">
                <input id="number" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="number" value="{{ old('number') }}" required autofocus>

                @if ($errors->has('number'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('number') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        {{-- Question name --}}
        <div class="form-group row">
            <label for="question" class="col-md-4 col-form-label text-md-right">{{ __('question') }}</label>

            <div class="col-md-6">
                <input id="question" type="text" class="form-control{{ $errors->has('question') ? ' is-invalid' : '' }}" name="question" value="{{ old('question') }}" required autofocus>

                @if ($errors->has('question'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('question') }}</strong>
                    </span>
                @endif
            </div>
        </div>


      {{-- Quizs_id--}}
        <div class="form-group row">
            <label for="quizs_id" class="col-md-4 col-form-label text-md-right">{{ __('quizs_id') }}</label>

            <div class="col-md-6">
                <input id="quizs_id" type="text" class="form-control{{ $errors->has('quizs_id') ? ' is-invalid' : '' }}" name="quizs_id" value="{{ old('quizs_id') }}" required autofocus>

                @if ($errors->has('quizs_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('quizs_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        {{-- Score--}}
        <div class="form-group row">
            <label for="score" class="col-md-4 col-form-label text-md-right">{{ __('score') }}</label>

            <div class="col-md-6">
                <input id="score" type="text" class="form-control{{ $errors->has('score') ? ' is-invalid' : '' }}" name="score" value="{{ old('score') }}" required autofocus>

                @if ($errors->has('score'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('score') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        {{-- Solution --}}
        <div class="form-group row">
            <label for="solution" class="col-md-4 col-form-label text-md-right">{{ __('solution') }}</label>

            <div class="col-md-6">
                <input id="solution" type="text" class="form-control{{ $errors->has('solution') ? ' is-invalid' : '' }}" name="solution" value="{{ old('solution') }}" required autofocus>

                @if ($errors->has('solution'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('solution') }}</strong>
                    </span>
                @endif
            </div>
        </div>


        {{-- questions_types_id --}}
        <div class="form-group row">
            <label for="questions_types_id" class="col-md-4 col-form-label text-md-right">{{ __('questions_types_id') }}</label>

            <div class="col-md-6">
                <input id="questions_types_id" type="text" class="form-control{{ $errors->has('') ? ' is-invalid' : '' }}" name="" value="{{ old('') }}" required autofocus>

                @if ($errors->has(''))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('') }}</strong>
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
