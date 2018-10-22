@extends('layouts.lecturer')



@section('content')

<body>



    <div class="container">
        <div class="row">
            <form action="{{route('blankQuestion.file')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="form-group">
                    <h1> blankQuestion</h1>
                </div>

                <div class="form-group">
                    <input type="file" name="fileName[]" multiple>
                </div>

                <div class="form-group">
                    {{Form::hidden ('Blank', 'Blank')}}

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
                    {{Form::label('score', 'score')}}
                    {{Form::text('score', '',['placeholder'=> 'Enter Score'])}}
                </div>
                <div class="form-group">
                    {{Form::hidden('quiz_id',$quiz_id)}}
                </div>


                <input type="submit" class="btn btn-info">
            </form>
        </div>

    </div>
</body>
@endsection

</html>