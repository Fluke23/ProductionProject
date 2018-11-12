@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-3">
            <h2>Edit Subject</h2>
        </div>
        <div class="col-md-9">

        </div>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ URL::to('quiz')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Subject</li>
        </ol>
    </nav>


    <div class="row">
        <form action="{{URL::to('/Setting/updateQuizStatus/')}}" method="post">
            @csrf

            {{-- groups id --}}
            <div class="form-group row">
                <label for="quizs_status_id" class="col-md-4 col-form-label text-md-right">{{ __('quizs_status_id') }}</label>

                <div class="col-md-6">
                    <input id="quizs_status_id" type="text" class="form-control{{ $errors->has('quizs_status_id') ? ' is-invalid' : '' }}"
                        name="quizs_status_id" value="{{$quiz_status->quizs_status_id}}" required autofocus readonly>

                    @if ($errors->has('quizs_status_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('quizs_status_id') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
             {{-- groups id --}}


            {{-- group name --}}
            <div class="form-group row">
                <label for="status_name" class="col-md-4 col-form-label text-md-right">{{ __('status_name') }}</label>

                <div class="col-md-6">
                    <input id="status_name" type="text" class="form-control{{ $errors->has('status_name') ? ' is-invalid' : '' }}"
                        name="status_name" value="{{$quiz_status->status_name}}" required autofocus>

                    @if ($errors->has('status_name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('status_name') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
             {{-- group name --}}


              {{-- mark --}}
            <div class="form-group row">
                <label for="marked" class="col-md-4 col-form-label text-md-right">{{ __('marked') }}</label>

                <div class="col-md-6">
                    <input id="marked" type="text" class="form-control{{ $errors->has('marked') ? ' is-invalid' : '' }}"
                        name="marked" value="{{$quiz_status->marked}}" required autofocus>

                    @if ($errors->has('marked'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('marked') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
              {{-- mark --}}


            <input type="hidden" name="quizs_status_id_old" value="{{ $quiz_status->quizs_status_id}}">

            <button type="reset" class="btn btn-danger">ยกเลิก</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>

        </form>
    </div>


</div>
@endsection
