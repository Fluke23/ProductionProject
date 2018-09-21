@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-3">
            <h2 >Multiple Question</h2>
            </div>
            <div class="col-md-9">
            
                </div>   
    </div>

    <div class="row">
    <form action="{{route('MultipleChoice.file')}}" method = "post"class="form-horizontal" enctype="multipart/form-data"> 
                {{csrf_field()}}


            <input type="file" name ="fileName[]" multiple>

        <div class="form-group">
            {{Form::hidden ('Multiple', 'Multiple')}}
 
        </div>   
         <div class="form-group">
            {{Form::label('number', 'number')}}
            {{Form::text('number', '',['class'=>'form-control','placeholder'=> 'Enter Number Question'])}}
            </div>  

        <div class="form-group">
            {{Form::label('name', 'solution')}}
            {{Form::text('name', '',['class'=>'form-control','placeholder'=> 'Enter solution'])}}
            </div>

        <div class="form-group">
            {{Form::label('question', 'question')}}
            {{Form::textarea('question', '',['class'=>'form-control','placeholder'=> 'Enter Question'])}}
        </div>

        <div class="form-group">
            {{Form::label('choice', 'choice')}}
            {{Form::textarea('choice', '',['class'=>'form-control','placeholder'=> 'Enter Choice 1'])}}
        </div>

        <div class="form-group">
            {{Form::label('choice', 'choice')}}
            {{Form::textarea('choice', '',['class'=>'form-control','placeholder'=> 'Enter Choice 2'])}}
        </div>

        <div class="form-group">
            {{Form::label('choice', 'choice')}}
            {{Form::textarea('choice', '',['class'=>'form-control','placeholder'=> 'Enter Choice 3'])}}
        </div>

        <div class="form-group">
            {{Form::label('choice', 'choice')}}
            {{Form::textarea('choice', '',['class'=>'form-control','placeholder'=> 'Enter Choice 4'])}}
        </div>

        <div class="form-group">
            {{Form::label('score', 'score')}}
            {{Form::text('score', '',['placeholder'=> 'Enter Score'])}}
        </div>

            <button type="reset" class="btn btn-danger">ยกเลิก</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
        </form>
    </div>
</div>
@endsection