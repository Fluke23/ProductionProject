@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-3">
            <h2>TrueFalse Question</h2>
        </div>
        <div class="col-md-9">

        </div>
    </div>

    <div class="row">
        <form action="{{route('lec.TrueFalse.file')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
            {{csrf_field()}}


             {{-- <input type="file" name ="fileName[]" multiple>  --}}

             <div class="form-group">
                {{Form::label('name', 'solution')}}
                {{Form::text('name', '',['class'=>'form-control','placeholder'=> 'Enter solution'])}}
            </div>

            @for ( $i=1 ;  $i<=$amount ; $i++)

            <div class="form-group">
                {{Form::hidden ('TrueFalse'.$i, 'TrueFalse')}}

            </div>
            <div class="form-group h5">
                {{Form::label('', 'No.'.$i)}}
            </div>
    
                <div class="form-group">
                    {{Form::label('number', 'number')}}
                    {{Form::text('number'.$i, '',['class'=>'form-control','placeholder'=> 'Enter Number Question'])}}
                </div>
    
                
    
                <div class="form-group">
                    {{Form::label('question', 'question')}}
                    {{Form::textarea('question'.$i, '',['class'=>'form-control','placeholder'=> 'Enter Question'])}}
                </div>
    
                <div class="form-group">
                    {{Form::label('score', 'score')}}
                    {{Form::text('score'.$i, '',['placeholder'=> 'Enter Score'])}}
                </div>
    
                <div class="form-group">
                    {{Form::hidden('quiz_id',$quiz_id)}}
                </div>
                
            @for ( $question=1 ;  $question<=2 ; $question++)
            <div class="form-group">
            {{Form::label('choice_'.$question.$i, 'Choice_'.$question)}}
            ถูก
            {{Form::radio('choice_type_id_'.$question.$i, '1')}}
            ผิด
            {{Form::radio('choice_type_id_'.$question.$i, '2')}}
            {{Form::text('choice_'.$question.$i, '',['class'=>'form-control','placeholder'=> 'Enter Choice'])}}            
            </div>
            @endfor
            <br><hr><br>
        @endfor 
            



            {{-- <div class="form-group">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 ">
                            <label for="question">Plase Select Number of Choice:</label>
                            <input class="form-control" type="text" v-model="choice">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary btn-sm" v-on:click="addQuiz(this.choice)">Add
                                Question</button>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-danger btn-sm">Delete choice</button>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="mt-2" v-for="quizs in quiz">
                            <div class="row" v-for="ch in quizs.choice">
                                <div class="mt-2">
                                    <div class="checkbox mt-3">
                                        {{Form::label('choice', 'choice')}}
                                        {{Form::text('choice', '',['class'=>'form-control','placeholder'=> 'Enter
                                        Choice'])}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <label for="question">Score:</label><br>
                                    <input type="text" value="" name="score" style="width:100px;">
                                </div>
                            </div>
                            <br><br><br>
                        </div>
                    </div>
                </div>
                <hr>
                <br> --}}
                <button type="reset" class="btn btn-danger">ยกเลิก</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>

                {{--
            </div> --}}
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