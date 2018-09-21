@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-3">
            <h2 >Edit Subject</h2>
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
    <form action="{{URL::to('/Admin/subject/updateSubject')}}" method="post">
       
        @csrf

        {{-- subject id --}}
        <div class="form-group row">
            <label for="subject_id" class="col-md-4 col-form-label text-md-right">{{ __('subject_id') }}</label>
            
            <div class="col-md-6">
            <input id="subject_id" type="text" class="form-control{{ $errors->has('subject_id') ? ' is-invalid' : '' }}" name="subject_id" value="{{$subject->subject_id}}" required autofocus>

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
            <input id="subject_name" type="text" class="form-control{{ $errors->has('subject_name') ? ' is-invalid' : '' }}" name="subject_name" value="{{$subject->subject_name}}" required autofocus>

                @if ($errors->has('subject_name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('subject_name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <input type="hidden" name="subject_id_old" value="{{ $subject->subject_id}}">

        <button type="reset" class="btn btn-danger">ยกเลิก</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
        
        </form>
    </div>


</div>
@endsection
