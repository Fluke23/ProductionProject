@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-4">
            <h2>TrueFalse Question</h2>
            
        </div>
        <div class="col-md-9">

        </div>
    </div>
    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/subject')}}">Home</a></li>
               <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/quiz')}}">Quizmanager</a></li>
              <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/question')}}">Questionmanager</a></li>
              <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/question/TrueFalse')}}">AddQuestion</a></li>
            </ol>
    </nav>
    <div class="row">
        <form action="{{route('TrueFalse.file')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
            {{csrf_field()}}


             {{-- <input type="file" name ="fileName[]" multiple>  --}}

            @for ( $i=1 ;  $i<=$amount ; $i++) 

            <div class="form-group h5">
            {{Form::label('', 'No.'.$i)}}
            </div>

            <div class="form-group">
                {{Form::hidden ('TrueFalse'.$i, 'TrueFalse')}}

            </div>
            <div class="form-group">
                {{Form::label('number'.$i, 'number')}}
                {{Form::text('number'.$i, '',['class'=>'form-control','placeholder'=> 'Enter Number Question'])}}
            </div>


            <div class="form-group">
                {{Form::label('question'.$i, 'question')}}
                {{Form::textarea('question'.$i, '',['class'=>'form-control','placeholder'=> 'Enter Question'])}}
            </div>

            <div class="form-group">
                {{Form::label('score'.$i, 'score')}}
                {{Form::text('score'.$i, '1')}}
            </div>

            <div class="form-group">
                {{Form::hidden('quiz_id',$quiz_id)}}
            </div>
                
            <div class="form-group">
            {{Form::label('Answer')}}
            True
            {{Form::radio('solution'.$i, 'True')}}
            False
            {{Form::radio('solution'.$i, 'False')}}       
            </div>
            
            <br><hr><br>
    @endfor
            <button type="reset" class="btn btn-danger">ยกเลิก</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
    </div>

    </form>
</div>
</div>
@endsection
{{-- @push('script')
<script>
    new Vue({
        el: '#app',
        data: {
            choice: '4',
            quiz: [],
        },
        methods: {
            addQuiz: function (choice) {
                var numQuiz = this.quiz.length + 1
                var countChocie = []
                for (var i = 1; i <= this.choice; i++) {
                    countChocie.push(i)
                }
                this.quiz.push({
                    'value': numQuiz,
                    'choice': countChocie
                })
            }
        }
    })
</script>
@endpush --}}