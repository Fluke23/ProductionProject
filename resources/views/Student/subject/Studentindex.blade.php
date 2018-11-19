

    @extends('layouts.student')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-4">
            <h2 >Home(Subject Manager)</h2>
            </div>
            <div class="col-md-8">
                {{-- @if($permission == 'ADMIN') <a href="{{ URL::to('subject/addSubject')}}" class="btn btn-success float-right">Add Subject</a> @endif --}}
            </div>   
    </div>

    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ URL::to('/Student/subject')}}">Home</a></li>
            
            </ol>
          </nav>

     {{-- body      --}}
 <div class="row d-flex justify-content-center mt-4">
    <div class="col-md-8 ">
        <table id="table" class="table">
        <thead>
        <tr>
                <th style="font-size: 1em;">subject ID</th>
                <th>Subject Name</th>
                <th>Option</th>
            </tr>

        </thead>
           
            <tbody>
                @foreach($subjects as $subject)
            <tr>
                    <td >
                    <a href="{{URL::to('/Student/quiz/StudentquizDetail/'.$subject->subject_id)}}" >{{$subject->subject_id}}</a>
                    </td>
                   
                    <td style="font-size: 0.8em;">{{$subject->subject_name}}</td>

                    <td >
                    <a href="{{URL::to('Student/quiz/StudentquizDetail/'.$subject->subject_id)}}" class="btn btn-info ">View</a>
                    </td>
                 
            </tr>
                 @endforeach
        </tbody>
        </table>
        
         
         <hr>
    </div>

 </div>

 @endsection
          