@extends('layouts.main')

@section('content')
<div class="container">
        
    <div class="row mb-2">
        <div class="col-md-3">
        <h2 >User detail</h2>
            </div>
            <div class="col-md-9">
            </div>   
    </div>


    <div class="row">
            <table class="table table-bordered">
                <tr>
                    <th style="font-size: 1em;width:40px;">Username</th>
                    <th style="width:40px;">Remark</th>
                    <th style="width:40px;">Firstname</th>
                    <th style="width:40px;">Lastname</th>
                    <th style="width:40px;">Subject ID</th>
                    <th style="width:40px;">Subject Name</th>
                    <th style="width:20px;">Student Group</th>
                    <th style="width:100px;"></th>
                </tr>
                <tbody>
                        @foreach($subject_user as $subject_user)
                    <tr>
                        <td style="font-size: 0.8em;">{{$subject_user->username}}</td>
                        <td style="font-size: 0.8em;">{{$subject_user->remark}}</td>
                        <td style="font-size: 0.8em;">{{$subject_user->firstname}}</td>
                        <td style="font-size: 0.8em;">{{$subject_user->lastname}}</td>
                        <td style="font-size: 0.8em;">{{$subject_user->subject_id}}</td>
                        <td style="font-size: 0.8em;">{{$subject_user->subject_name}}</td>
                        <td style="font-size: 0.8em;">{{$subject_user->student_group_name}}</td>
                        <td >
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

