@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-3">
            <h2 >User Manager</h2>
            </div>
            <div class="col-md-9">
            <a href="{{ URL::to('/userManager/addGroupUser')}}" class="btn btn-success float-right">Add Group User</a>
            </div>   
    </div>


    <div class="row">
            <table class="table table-bordered">
                <tr>
                    <th style="font-size: 1em;width:30px;">Username</th>
                    <th style="width:50px;">Remark</th>
                    <th style="width:50px;">Firstname</th>
                    <th style="width:50px;">Lastname</th>
                    <th style="width:100px;"></th>
                </tr>
                <tbody>
                    @foreach($user as $user)
                    <tr>
                        <td style="font-size: 0.8em;">{{$user->username}}</td>
                        <td style="font-size: 0.8em;">{{$user->remark}}</td>
                        <td style="font-size: 0.8em;">{{$user->firstname}}</td>
                        <td style="font-size: 0.8em;">{{$user->lastname}}</td>
                        <td >
                        <a href="{{URL::to('/Admin/userManager/viewUserInfo/'.$user->username)}}" class="btn btn-info btn-sm">View</a>
                                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                <a href="{{ URL::to('/Admin/userManager/delete/'.$user->username)}}" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
             <hr>
        </div>

    @endsection

