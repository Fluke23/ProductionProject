@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-3">
            <h2 >Add Subject</h2>
            </div>
            <div class="col-md-9">
                
                </div>   
    </div>

    <div class="row">
    <form action="{{URL::to('/Admin/subject/saveSubject')}}" method="post">
        @csrf

        {{-- subject id --}}
        <div class="form-group row">
            <label for="subject_id" class="col-md-4 col-form-label text-md-right">{{ __('subject_id') }}</label>

            <div class="col-md-6">
                <input id="subject_id" type="text" class="form-control{{ $errors->has('subject_id') ? ' is-invalid' : '' }}" name="subjectId" value="{{ old('subject_id') }}" required autofocus>

                @if ($errors->has('subject_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('subject_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        {{-- subject name --}}
        <div class="form-group row">
            <label for="subject_name" class="col-md-4 col-form-label text-md-right">{{ __('subject_name') }}</label>

            <div class="col-md-6">
                <input id="subject_name" type="text" class="form-control{{ $errors->has('subject_name') ? ' is-invalid' : '' }}" name="name" value="{{ old('subject_name') }}" required autofocus>

                @if ($errors->has('subject_name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('subject_name') }}</strong>
                    </span>
                @endif
            </div>
        </div>



        <button type="reset" class="btn btn-danger">ยกเลิก</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
        
        </form>
    </div>


</div>

@endsection
