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
            <li class="breadcrumb-item active" aria-current="page">Edit Subject</li>
        </ol>
    </nav>

<div class="card">
    <div class="card-body">
        <form action="{{URL::to('/Setting/updateSubject/')}}" method="post">
            @csrf

            {{-- subject id --}}
            <div class="form-group row">
                <label for="subject_id" class="col-md-4 col-form-label text-md-right">{{ __('Subject ID : ') }}</label>

                <div class="col-md-6">
                    <input id="subject_id" type="text" class="form-control{{ $errors->has('subject_id') ? ' is-invalid' : '' }}"
                        name="subject_id" value="{{$subject->subject_id}}" required autofocus readonly>

                    @if ($errors->has('subject_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('subject_id') }}</strong>
                    </span>
                    @endif
                </div>
            </div>


            {{-- subject name --}}
            <div class="form-group row">
                <label for="subject_name" class="col-md-4 col-form-label text-md-right">{{ __('Subject Name : ') }}</label>

                <div class="col-md-6">
                    <input id="subject_name" type="text" class="form-control{{ $errors->has('subject_name') ? ' is-invalid' : '' }}"
                        name="subject_name" value="{{$subject->subject_name}}" required autofocus>

                    @if ($errors->has('subject_name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('subject_name') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <input type="hidden" name="subject_id_old" value="{{ $subject->subject_id}}">

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
