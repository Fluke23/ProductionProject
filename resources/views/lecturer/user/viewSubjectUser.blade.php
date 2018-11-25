@extends('layouts.lecturer')

@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-3">
            <h2>{{ $subject_id }}  </h2>
        </div>

        
    </div>
    <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ URL::to('/Lecturer/subject')}}">Home</a></li>
                 <li class="breadcrumb-item active">View User in Subject</li>
                </ol>
    </nav>
     {{-- Nav-tab --}}
   <ul class="nav nav-tabs mb-3">
        @if(Request::is('Lecturer/subject/viewSubjectUser/'.$subject_id) == 'Lecturer/subject/viewSubjectUser/'.$subject_id)
            <li class="nav-item">
                <a class="nav-link active" href="{{URL::to('Lecturer/subject/viewSubjectUser/'.$subject_id)}}">All</a>
            </li>
              @foreach($group as $g)
            <li class="nav-item">
                <a class="nav-link " href="{{URL::to('/Lecturer/subject/viewSubjectUserGroup/'.$subject_id.'/'.$g->groups_id)}}">{{$g->groups_id}}</a>
            </li> 
             @endforeach
            
        @else
             <li class="nav-item">
                <a class="nav-link " href="{{URL::to('Lecturer/subject/viewSubjectUser/'.$subject_id)}}">All</a>
            </li>
            @foreach($group as $g)
                @if(Request::is('Lecturer/subject/viewSubjectUserGroup/'.$subject_id.'/'.$g->groups_id) == 'Lecturer/subject/viewSubjectUserGroup/'.$subject_id.'/'.$g->groups_id)
                <li class="nav-item">
                    <a class="nav-link active" href="{{URL::to('/Lecturer/subject/viewSubjectUserGroup/'.$subject_id.'/'.$g->groups_id)}}">{{$g->groups_id}}</a>
                </li> 
                @else
                 <li class="nav-item">
                    <a class="nav-link" href="{{URL::to('/Lecturer/subject/viewSubjectUserGroup/'.$subject_id.'/'.$g->groups_id)}}">{{$g->groups_id}}</a>
                </li> 
                @endif
             @endforeach
         @endif
    </ul>
     {{-- Nav-tab --}}
    
    
    
    {{--  ADMIN  --}}
    <div class="row">
        <div class="col-md-12">
            <table id="table">
            <thead>
                <tr>
                <th style="font-size: 1em;">Username</th>
                 <th style="font-size: 1em;">Firstname</th>
                  <th style="font-size: 1em;">Lastname</th>
                  <th style="font-size: 1em;">Group</th>
                  <th style="">Option</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach($subject_user as $su)
                <tr>
                 
                        <td style="font-size: 0.8em;">{{$su->username}}</td>
                        <td style="font-size: 0.8em;">{{$su->firstname}}</td>
                        <td style="font-size: 0.8em;">{{$su->lastname}}</td>
                        <td style="font-size: 0.8em;">{{$su->groups_id}}</td>
                        @if($su->groups_id != "ADMIN" )
                        <td> <a href="{{ URL::to('/Admin/userManager/delete/'.$su->username)}}" class="btn btn-danger btn-sm" onclick="return ConfirmDelete();">Delete</a></td>
                        @endif
                </tr>

                @endforeach
            </tbody>

        </table>
        </div>
        
        <hr>
    </div>
     {{--  ADMIN  --}}




</div>
        <!-- JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/alertify.min.js"></script>

<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/themes/default.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/themes/semantic.min.css"/>
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/themes/bootstrap.min.css"/>

@if(session('success'))
<script type="text/javascript">
        $(document).ready(function(){
            alertify.success('{{session('success')}}');
        });
</script>
@endif


@endsection