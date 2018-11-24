@extends('layouts.lecturer')
@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-4">
            <h2>True/False Question</h2>
            
        </div>
        <div class="col-md-9">

        </div>
    </div>

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/subject')}}">Home</a></li>
               <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/quiz')}}">Quizmanager</a></li>
              <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/question')}}">Questionmanager</a></li>
              <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/question/TrueFalse')}}">AddQuestion</a></li>
            </ol>
    </nav>
    {{-- Breadcrumb --}}


    <div class="card">
        <div class="card-body">
             <form action="{{route('TrueFalse.file')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
            {{csrf_field()}}

             {{-- <input type="file" name ="fileName[]" multiple>  --}}

            @for ( $i=1 ;  $i<=$amount ; $i++) 

            <div class="badge badge-dark h4 mb-3">
            {{Form::label('', 'No.'.$i,['class'=>'h4 p-1'])}}
            </div>

            <div class="form-group">
                {{Form::hidden ('TrueFalse'.$i, 'TrueFalse')}}

            </div>
            <div class="form-group">
                <strong>   {{Form::label('number'.$i, 'Number : ')}} </strong>
                {{Form::text('number'.$i, '',['class'=>'form-control','placeholder'=> 'Enter Number Question'])}}
            </div>


            <div class="form-group">
               <strong>    {{Form::label('question'.$i, 'Question : ')}} </strong>
                {{Form::textarea('question'.$i, '',['class'=>'form-control','placeholder'=> 'Enter Question'])}}
            </div>

            <div class="form-group">
                <strong>   {{Form::label('score'.$i, 'Score : ')}} </strong>
                {{Form::text('score'.$i, '1',['class'=>'form-control col-md-2','placeholder'=> 'Score'])}}
            </div>

            <div class="form-group">
                {{Form::hidden('quiz_id',$quiz_id)}}
            </div>
                
            <div class="form-group">
             <strong>  {{Form::label('Answer : ')}}&nbsp; &nbsp; </strong>
            True
            {{Form::radio('solution'.$i, 'True')}}
            &nbsp; &nbsp;
            False
            {{Form::radio('solution'.$i, 'False')}}       
            </div>
            
                <hr><br>
    @endfor
            <div class="form-group text-right">
                <a class="btn btn-danger mr-2 px-5" href="{{url()->previous()}}">Cancel</a>
                <input type="submit" class = "btn btn-info px-5">
             </div>
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