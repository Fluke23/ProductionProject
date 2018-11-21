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
         <li class="nav-item">
                <a class="nav-link " href="/Admin/setting">All</a>
            </li>
        @if(Request::is('Admin/setting/indexSubject') == 'Admin/setting/indexSubject')
            <li class="nav-item">
                <a class="nav-link active" href="#">Subject</a>
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
        @endif
    </ul>
{{-- Nav-tab --}}
   


    {{-- Row --}}
    <div class="row">

       
        {{-- Subject --}}
        <div class="m-1">
            <h5 class="">SUBJECT</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th style="font-size: 0.8em">Subject ID</th>
                        <th style="font-size: 0.8em">Subject Name</th>
                        <th style="font-size: 0.8em">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($subjects as $subject)
                    <tr>
                        <td style="font-size: 0.8em">{{$subject->subject_id}}</td>

                        <td style="font-size: 0.8em">{{$subject->subject_name}}</td>
                        <td style="font-size: 0.8em">

                            <a href="{{ URL::to('//Setting/editSubject/'.$subject->subject_id)}}" class="btn btn-warning"
                                style="font-size: 0.8em">Edit</a>
                            <a href="{{ URL::to('/Setting/deleteSubject/'.$subject->subject_id)}}" class="btn btn-danger"
                                style="font-size: 0.8em" Onclick="return ConfirmDelete();">Delete</a>
                        </td>
                    </tr>
                    @endforeach

                    <form action="{{URL::to('/Setting/saveSubject')}}" method="post">
                        @csrf
                        <tr>
                            <td><input id="subject_id" type="text" name="subject_id" value="{{ old('subject_id') }}"
                                    required autofocus> </td>
                            <td><input id="subject_name" type="text" name="subject_name" value="{{ old('subject_name') }}"
                                    required autofocus></td>
                            <td>
                                {{-- <a href="{{ URL::route('addSubject') }}" class="btn btn-success float-right">Add
                                </a> --}}
                                <button type="submit" class="btn btn-success px-4" style="font-size: 0.8em">ADD</button>
                            </td>
                        </tr>
                    </form>

                </tbody>

            </table>
        </div>
        {{-- Subject --}}
      

       
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
