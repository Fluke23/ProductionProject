
@extends('layouts.main')

@section('content')
<body>
    <div class="container">
         <h1> Blank Question</h1>
    

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
        <div class="">
            <div class="card">
                <div class="card-body">
                  
                    <form action="{{route('blankQuestion.file')}}" method = "post"class="form-horizontal" enctype="multipart/form-data"> 
                            {{csrf_field()}}
                    <!-- {{-- Number --}} 
                    <div class="form-group mb-4">
                        {{Form::label('number', 'Number : ')}}
                        {{Form::text('number', '',['class'=>'form-control col-md-3','placeholder'=> 'Enter Number Question'])}}
                    </div> 
                    {{-- Number --}}-->

                    {{-- File --}}
                    <div class="form-group mb-4">
                    <input type="file" name ="fileName" multiple>
                    </div>
                    {{-- File --}}
                            
                    <div class="form-group mb-4">
                        {{Form::hidden ('Blank', 'Blank')}}
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
                        {{Form::text('score', '',['class'=>'form-control col-md-2','placeholder'=> 'Enter Score'])}}
                    </div>
                    {{-- Score --}}

                    <div class="form-group">
                    {{Form::hidden('quiz_id',$quiz_id)}}
                    </div>

         

                    <div class="col-md-12 text-right">
                    <input type="submit" class = "btn btn-info px-5">
                    </div>

                    </form>
                </div>
                
            </div>
              
        </div>       
    </div>
</body>

@endsection
</html>



   
