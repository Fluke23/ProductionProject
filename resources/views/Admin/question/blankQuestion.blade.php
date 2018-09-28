
@extends('layouts.main')



@section('content')
<body>
    <div class="container">
         <h1> blankQuestion</h1>
    

    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/subject')}}">Home</a></li>
               <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/quiz')}}">Quizmanager</a></li>
              <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/question')}}">Questionmanager</a></li>
              <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/blankQuestion')}}">AddQuestion</a></li>
            </ol>
    </nav>    
    </div> 
    <div class="container">
        <div class="row">
        <br>
            <form action="{{route('blankQuestion.file')}}" method = "post"class="form-horizontal" enctype="multipart/form-data"> 
                {{csrf_field()}}

                <input type="file" name ="fileName" multiple>
                
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

         
        <input type="submit" class = "btn btn-info">
    </form>
        </div>
           
    </div>
</body>
@endsection
</html>



   
