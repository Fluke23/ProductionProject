@extends('layouts.main')

@section('content')
<div class="container">
    {{-- breadcrumb --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/userManager')}}">User Manager</a></li>
            <li class="breadcrumb-item">
            @foreach($subject_user as $subject_users)
         @endforeach

    
      {{$subject_users->username}}
      
      {{$subject_users->firstname}}
      {{$subject_users->lastname}}

    </li>
        </ol>
    </nav>
    {{-- breadcrumb --}}
    <div class="row mb-2">
        <div class="col-md-3">
            <h2>User detail </h2>
        </div>
        <div class="col-md-9">
        </div>
    </div>


  
    <div class="col-md-12">

        <table id="table">
            <thead>
                <tr>

                    <th style="width:40px;">Subject ID</th>
                    <th style="width:40px;">Subject Name</th>
                    <th style="width:20px;">Student Group</th>
                    <th style="width:100px;"></th>
                </tr>
            </thead>

            <tbody>
                @foreach($subject_user as $subject_user)
                <tr>

                    <td style="font-size: 0.8em;">{{$subject_user->subject_id}}</td>
                    <td style="font-size: 0.8em;">{{$subject_user->subject_name}}</td>
                    <td style="font-size: 0.8em;">{{$subject_user->student_group_name}}</td>
                    <td>
                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <hr>
    </div>

</div>

@endsection
