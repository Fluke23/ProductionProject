@extends('layouts.main')

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
    
    
    
    <div class="row mb-4 mt-5">
        <h5>LECTURER</h5>
        <table class="table table-bordered">
            <tr>
                <th style="font-size: 1em;">Username</th>
                 <th style="font-size: 1em;">Firstname</th>
                  <th style="font-size: 1em;">Lastname</th>
                  <th style="">Option</th>
            </tr>

            <tbody>
                @foreach($subject_user as $su)
                <tr>
                 @if($su->groups_id != 'STUDENT')
                    <td style="font-size: 0.8em;">{{$su->username}}</td>
                    <td style="font-size: 0.8em;">{{$su->firstname}}</td>
                    <td style="font-size: 0.8em;">{{$su->lastname}}</td>
                    @if($su->groups_id != "ADMIN" )
                    <td> <a href="{{ URL::to('/Admin/userManager/delete/'.$su->username)}}" class="btn btn-danger btn-sm">Delete</a></td>
                    @endif
                </tr>
                @endif

                @endforeach
            </tbody>

        </table>


        <hr>
    </div>

     
    <div class="row ">
        <h5>STUDENT</h5>
        <table class="table table-bordered" w>
            <tr>
                 <th style="font-size: 1em;">Username</th>
                 <th style="font-size: 1em;">Firstname</th>
                  <th style="font-size: 1em;">Lastname</th>
                  <th>Option</th>
            </tr>

            <tbody>
                @foreach($subject_user as $su)
                <tr>
                 @if($su->groups_id != 'ADMIN')
                         @if($su->groups_id != 'LECTURER')
                    <td style="font-size: 0.8em;">{{$su->username}}</td>
                    <td style="font-size: 0.8em;">{{$su->firstname}}</td>
                    <td style="font-size: 0.8em;">{{$su->lastname}}</td>
                    <td> <a href="{{ URL::to('/Admin/subject/viewSubjectUser/delete/'.$su->username)}}" class="btn btn-danger btn-sm">Delete</a></td>
                        @endif
                </tr>
                @endif

                @endforeach
            </tbody>

        </table>


        <hr>
    </div>


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