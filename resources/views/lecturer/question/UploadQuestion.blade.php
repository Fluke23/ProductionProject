@extends('layouts.lecturer')
@extends('layouts.main')



@section('content')
<body>
<div class="container">
         <h1> Upload Question</h1>

<nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/subject')}}">Subject Manager</a></li>
               <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/quiz')}}">Quiz Manager</a></li>
              <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/question')}}">Question Manager</a></li>
              <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/UploadQuestion')}}">Add Question</a></li>
            </ol>
</nav>
</div>  
    <div class="container">
        <div class="card">
            <div class="card-body">
            <form action="{{route('UploadQuestion.file')}}" method = "post"class="form-horizontal" enctype="multipart/form-data"> 
                    {{csrf_field()}}
                
             {{-- Number --}}
            <div class="form-group mb-4">
                {{Form::label('number', 'Number : ')}}
                {{Form::text('number', '',['class'=>'form-control col-md-3','placeholder'=> 'Enter Number Question'])}}
            </div>  
            {{-- Number --}} 

            <input type="file" name ="fileName" multiple>

            <div class="form-group">
                {{Form::hidden('Upload', 'Upload')}}
            </div>  
            
             {{-- Question --}}
            <div class="form-group mb-4">
                {{Form::label('question', 'Question : ')}}
                {{Form::textarea('question', '',['class'=>'form-control','placeholder'=> 'Enter Question'])}}
            </div>
            {{-- Question --}}

            {{-- Solution --}}
            <div class="form-group mb-4">
                {{Form::label('name', 'Solution : ')}}
                {{Form::text('name', '',['class'=>'form-control','placeholder'=> 'Enter solution'])}}
            </div>
            {{-- Solution --}}


            {{-- Score --}}
            <div class="form-group mb-4">
                {{Form::label('score', 'Score : ')}}
                {{Form::text('score', '',['class'=>'form-control col-md-3','placeholder'=> 'Enter Score'])}}
            </div>
            {{-- Score --}}

            <div class="form-group">
                {{Form::hidden('quiz_id',$quiz_id)}}
            
            </div>

            <div class="form-group text-right">
                <input type="submit" class = "btn btn-info px-4">
            </div>
            </form>
            </div>
            
        </div>  
    </div>
</body>
@endsection
</html>



   
