@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-6">
            <h2>Edit Student Group</h2>
        </div>
        <div class="col-md-6">

        </div>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Edit Student group name</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
        <form action="{{URL::to('/Setting/updateStudentGroup/')}}" method="post">
            @csrf

           


            {{-- student group name--}}
            <div class="form-group row">
                <label for="student_group_name" class="col-md-4 col-form-label text-md-right">{{ __('Student Group Name : ') }}</label>

                <div class="col-md-6">
                    <input id="student_group_name" type="text" class="form-control{{ $errors->has('student_group_name') ? ' is-invalid' : '' }}"
                        name="student_group_name" value="{{$student_group->student_group_name}}" required autofocus>

                    @if ($errors->has('student_group_name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('student_group_name') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
             {{-- student group name--}}


            <input type="hidden" name="student_group_id_old" value="{{ $student_group->student_group_id}}">
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
