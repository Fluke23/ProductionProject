@extends('layouts.main')

@section('content')


{{-- Container --}}
<div class="container">

    <div class="row mb-2">
        <div class="col-md-4">
            <h2>Setting</h2>
        </div>
    </div>
    {{-- Alert --}}
    @if(Session::has('unsuccess'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Cannot add data because of it has already. </strong> {{ Session::get('message', '') }}
    </div>
    @endif
    @if(Session::has('successAdd'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Add data successful.</strong> {{ Session::get('message', '') }}
    </div>
    @endif
    @if(Session::has('successEdit'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Edit data successful.</strong> {{ Session::get('message', '') }}
    </div>
    @endif
    @if(Session::has('successDelete'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Delete data successful.</strong> {{ Session::get('message', '') }}
    </div>
    @endif
    {{-- Alert --}}

    {{-- breadcrumb --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
             <li class="breadcrumb-item active">Setting</li>
        </ol>
    </nav>
    {{-- breadcrumb --}}

    {{-- Nav-tab --}}
    <ul class="nav nav-tabs mb-3">
        @if(Request::is('Admin/setting/indexStudentGroup') == 'Admin/setting/indexStudentGroup')
        <li class="nav-item">
                <a class="nav-link " href="/Admin/setting">All</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="/Admin/setting/indexSubject">Subject</a>
            </li>
            <li class="nav-item">
            <a class="nav-link " href="/Admin/setting/indexUserGroup">User Group</a>
            </li>  
         <li class="nav-item">
            <a class="nav-link " href="/Admin/setting/indexQuizType">Quiz Type</a>
        </li>  
        <li class="nav-item">
            <a class="nav-link " href="/Admin/setting/indexQuizStatus">Quiz Status</a>
        </li>  
        <li class="nav-item">
            <a class="nav-link active" href="#">Student Group</a>
        </li>  
        @endif
    </ul>
{{-- Nav-tab --}}
   


    {{-- Row --}}
    <div class="row">

         {{-- Student Group --}}

           <div class="m-1 ml-3">

            <h5 class="">STUDENT GROUP</h5>
            <table class="table">

                <thead>
                    <tr>
                        <th style="font-size: 0.8em">Student Group</th>
                        <th style="font-size: 0.8em">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($student_group as $sg)
                    <tr>
                       
                        <td style="font-size: 0.8em">{{$sg->student_group_name}}</td>
                        <td style="font-size: 0.8em">

                            <a href="{{ URL::to('/Setting/editStudentGroup/'.$sg->student_group_id)}}" class="btn btn-warning"
                                style="font-size: 0.8em">Edit</a>
                            <a href="{{ URL::to('/Setting/deleteStudentGroup/'.$sg->student_group_id)}}" class="btn btn-danger"
                                style="font-size: 0.8em" onclick="return ConfirmDelete();">Delete</a>
                        </td>

                    </tr>
                    @endforeach

                    <form action="{{URL::to('/Setting/saveStudentGroup')}}" method="post">
                        @csrf
                        <tr>
                            <td>
                                <input id="student_group_name" type="text" name="student_group_name" value="{{ old('student_group_name') }}" required autofocus></td>
                            </td>

                            <td>
                                <button type="submit" class="btn btn-success px-4" style="font-size: 0.8em">ADD</button>
                            </td>
                        </tr>
                    </form>

                </tbody>

            </table>
        </div>
        {{-- Student Group --}}

       
    </div>
    {{-- Row --}}








</div>
{{-- Container --}}

{{-- JavaScript --}}
<script>
    function ConfirmDelete() {
        var x = confirm("Are you sure you want to delete?");
        if (x)
            return true;
        else
            return false;
    }

</script>

{{-- JavaScript --}}

@endsection
