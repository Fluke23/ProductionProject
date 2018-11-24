@extends('layouts.lecturer')

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
    <div class="card">

        <div class="card-body">
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

            <div class="badge badge-dark h4 mb-3">
                {{Form::label('', 'No.'.$i,['class'=>'h4 p-1'])}}
            </div>

            <div class="form-group">
              <strong>  {{Form::label('number'.$i, 'Number :')}}</strong>
                {{Form::text('number'.$i, '',['class'=>'form-control','placeholder'=> 'Enter Number Question'])}}
            </div>


            <div class="form-group">
                <strong> {{Form::label('question'.$i, 'Question : ')}}</strong>
                {{Form::textarea('question'.$i, '',['class'=>'form-control','placeholder'=> 'Enter Question'])}}
            </div>

            <div class="form-group">
                <strong> {{Form::label('score'.$i, 'Score : ')}}</strong>
                {{Form::text('score'.$i, '1',['class'=>'form-control col-md-2','placeholder'=> 'Score'])}}
            </div>

            <div class="form-group">
                {{Form::hidden('quiz_id',$quiz_id)}}
            </div>
                
            @for ( $question=1 ;  $question<=4 ; $question++)
            <div class="form-group">
             <strong>{{Form::label('choice_'.$question.$i, 'Choice '.$question.'  :   ')}}&nbsp; &nbsp;</strong>
            <!-- {{Form::checkbox('choice_type_id_'.$question,'1')}} -->
            ถูก
            {{Form::radio('choice_type_id_'.$question.$i, '1')}}
                &nbsp;&nbsp;&nbsp;
            ผิด
            {{Form::radio('choice_type_id_'.$question.$i, '2',true)}}
            {{Form::text('choice_'.$question.$i, '',['class'=>'form-control','placeholder'=> 'Enter Choice '])}}            
            </div>
            @endfor

            <br><hr><br>
        @endfor
           
            <div class="form-group text-right">
                <a class="btn btn-danger mr-2 px-5" href="{{url()->previous()}}">Cancel</a>
                <input type="submit" class = "btn btn-info px-5">
             </div>
                {{-- <button type="reset" class="btn btn-danger">ยกเลิก</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button> --}}

    </div>

    </form>
        </div>
        
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