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
            <li class="breadcrumb-item active" aria-current="page">Edit Quiz Type</li>
        </ol>
    </nav>

<div class="card">
<div class="card-body">
        <form action="{{URL::to('/Setting/updateQuizType/')}}" method="post">
            @csrf

            {{-- quizs_type id --}}
            <div class="form-group row">
                <label for="quizs_types_id" class="col-md-4 col-form-label text-md-right">{{ __('Quizs Types ID : ') }}</label>

                <div class="col-md-6">
                    <input id="quizs_types_id" type="text" class="form-control{{ $errors->has('quizs_types_id') ? ' is-invalid' : '' }}"
                        name="quizs_types_id" value="{{$quiz_type->quizs_types_id}}" required autofocus readonly>

                    @if ($errors->has('quizs_types_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('quizs_types_id') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
             {{-- quizs_types_id --}}


            {{-- type name --}}
            <div class="form-group row">
                <label for="type_name" class="col-md-4 col-form-label text-md-right">{{ __('Quiz Type Name : ') }}</label>

                <div class="col-md-6">
                    <input id="type_name" type="text" class="form-control{{ $errors->has('type_name') ? ' is-invalid' : '' }}"
                        name="type_name" value="{{$quiz_type->type_name}}" required autofocus>

                    @if ($errors->has('type_name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('type_name') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
             {{-- type name --}}

             


            <input type="hidden" name="quizs_types_id_old" value="{{ $quiz_type->quizs_types_id}}">

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
