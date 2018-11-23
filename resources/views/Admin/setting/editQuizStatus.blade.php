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
            <li class="breadcrumb-item active">Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Edit Quiz Status</li>
        </ol>
    </nav>

    <div class="card">
             <div class="card-body">
        <form action="{{URL::to('/Setting/updateQuizStatus/')}}" method="post">
            @csrf

            {{-- groups id --}}
            <div class="form-group row">
                <label for="quizs_status_id" class="col-md-4 col-form-label text-md-right">{{ __('Quizs Status ID : ') }}</label>

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
                <label for="status_name" class="col-md-4 col-form-label text-md-right">{{ __('Quiz Status Name : ') }}</label>

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


            


            <input type="hidden" name="quizs_status_id_old" value="{{ $quiz_status->quizs_status_id}}">

             {{--  button  --}}
            <div class="col-md-12 text-center">
                <a class="btn btn-danger mr-2" href="{{url()->previous()}}">Cancel</a>
                <button type="submit" class="btn btn-success px-4">Save</button>
            </div>
            {{--  button  --}}

        </form>
    </div>
    </div>
   


</div>
@endsection
