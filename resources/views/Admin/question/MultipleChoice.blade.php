@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-3 display-2">
            <h2>Multiple Question</h2>
        </div>
        <div class="col-md-9">

        </div>
    </div>

    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/subject')}}">Home</a></li>
               <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/quiz')}}">Quizmanager</a></li>
              <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/question')}}">Questionmanager</a></li>
              <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/question/MultipleChoice')}}">AddQuestion</a></li>
            </ol>
    </nav>
    <div class="row">
        <form action="{{route('MultipleChoice.file')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="form-group">
                <!-- {{Form::label('name', 'solution')}} -->
                {{Form::hidden('name', '',['class'=>'form-control','placeholder'=> 'Enter solution'])}}
            </div>

             {{-- <input type="file" name ="fileName[]" multiple>  --}}
    @for ( $i=1 ;  $i<=$amount ; $i++) 
            <div class="form-group">
                {{Form::hidden ('Multiple'.$i, 'Multiple')}}
            </div>

        <div class="form-group h5">
            {{Form::label('', 'No.'.$i)}}
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
                
            @for ( $question=1 ;  $question<=4 ; $question++)
            <div class="form-group">
            {{Form::label('choice_'.$question.$i, 'Choice_'.$question)}}
            <!-- {{Form::checkbox('choice_type_id_'.$question,'1')}} -->
            ถูก
            {{Form::radio('choice_type_id_'.$question.$i, '1')}}
            ผิด
            {{Form::radio('choice_type_id_'.$question.$i, '2',true)}}
            {{Form::text('choice_'.$question.$i, '',['class'=>'form-control','placeholder'=> 'Enter Choice'])}}            
            </div>
            @endfor

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