@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-3">
            <h2>User Manager</h2>
        </div>
        <div class="col-md-9">
            <a href="{{URL::route('importFile')}}" class="btn btn-info float-right"><i class="fas fa-file-import"></i>
                ImportFile</a>
            <a href="{{ URL::to('/Admin/user/addGroupUser')}}" class="btn btn-success float-right mr-3"><i class="fas fa-plus"></i>
                Subject Group</a>
            <a href="{{ URL::to('/Admin/user/addTypeGroupUser')}}" class="btn btn-success float-right mr-3"><i class="fas fa-plus"></i>
                User Group</a>

        </div>
        <!--  <div class="col-md-9">
                <a href="{{ URL::to('/Admin/user/createUser')}}" class="btn btn-success float-right"> User</a>
            </div>  -->
        <div class="col-md-12">
            <a href="{{ URL::route('createUser') }}" class="btn btn-success float-right" data-toggle="modal"
                data-target="#exampleModal">Create User</a>
        </div>
    </div>
    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/subject')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/userManager')}}">UserManager</a></li>
            </ol>
        </nav>

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
                    <td>
                        <a href="{{URL::to('/Admin/userManager/viewUserInfo/'.$user->username)}}" class="btn btn-info btn-sm">View</a>
                        <a href="{{URL::to('/Admin/userManager/editUser/'.$user->username)}}" class="btn btn-warning btn-sm">Edit</a>
                        @if($user->username != 'Admin')
                        <a href="{{ URL::to('/Admin/userManager/delete/'.$user->username)}}" class="btn btn-danger btn-sm">Delete</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <hr>
    </div>



    <!-- modal create user -->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Create User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <form action="{{URL::to('/Admin/user/saveUser')}}" method="post" id="addForm">
                            @csrf

                            <div class="row justify-content-center">
                                <div class="col-md-12">


                                   
                                        @csrf

                                        <div class="form-group row">
                                            <label for="username" class="col-md-4 col-form-label text-md-right">{{
                                                __('username') }}</label>

                                            <div class="col-md-6">
                                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                                    name="username" value="{{ old('username') }}" required autofocus>

                                                @if ($errors->has('username'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('username') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- <div class="form-group row">
                                            <label for="group_id" class="col-md-4 col-form-label text-md-right">{{
                                                __('group_id') }}</label>

                                            <div class="col-md-6">
                                                <input id="group_id" type="text" class="form-control{{ $errors->has('group_id') ? ' is-invalid' : '' }}"
                                                    name="group_id" value="{{ old('group_id') }}" required autofocus>

                                                @if ($errors->has('group_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('group_id') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div> --}}

                                        <div class="form-group row">
                                            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{
                                                __('firstname') }}</label>

                                            <div class="col-md-6">
                                                <input id="firstname" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}"
                                                    name="firstname" value="{{ old('firstname') }}" required autofocus>

                                                @if ($errors->has('firstname'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('firstname') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{
                                                __('lastname') }}</label>

                                            <div class="col-md-6">
                                                <input id="lastname" type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}"
                                                    name="lastname" value="{{ old('lastname') }}" required autofocus>

                                                @if ($errors->has('lastname'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('lastname') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="remark" class="col-md-4 col-form-label text-md-right">{{
                                                __('remark') }}</label>

                                            <div class="col-md-6">
                                                {{Form::select('remark', array('นาย'=>'นาย' ,
                                                'นาง'=>'นาง','นางสาว'=>'นางสาว'))}}
                                                @if ($errors->has('remark'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('remark') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>



                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">{{
                                                __('Password') }}</label>

                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                    name="password" required>

                                                @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{
                                                __('Confirm Password') }}</label>

                                            <div class="col-md-6">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-5 col-form-label text-md-right">
                                                <label for="Change_Password">Change Password</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="radio" name="Change_Password" <?php if
                                                    (isset($Change_Password) && $Change_Password=="tres_important" ) ;?>
                                                value="Y">Yes
                                                <input type="radio" name="Change_Password" checked="checked" <?php if
                                                    (isset($Change_Password) && $Change_Password=="Change_Password" )
                                                    ;?>
                                                value="N">No
                                            </div>
                                        </div>





                                        <div class="form-group row">
                                            <label for="groups_id" class="col-md-4 col-form-label text-md-right">{{
                                                __('group ') }}</label>
                                            {{Form::select('groups_id', array('ADMIN'=>'Admin' ,
                                            'LECTURER'=>'Lecturer','STUDENT'=>'Student'))}}

                                            @if ($errors->has('groups_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('groups_id') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-danger">ยกเลิก</button>
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> บันทึก</button>

                            </div>

                    </div>


                </div>

                </form>


            </div>


            <!-- JavaScript -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/alertify.min.js"></script>

            <!-- CSS -->
            <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/alertify.min.css" />
            <!-- Default theme -->
            <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/themes/default.min.css" />
            <!-- Semantic UI theme -->
            <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/themes/semantic.min.css" />
            <!-- Bootstrap theme -->
            <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/themes/bootstrap.min.css" />

            @if(session('success'))
            <script type="text/javascript">
                $(document).ready(function () {
                    alertify.success('{{session('
                        success ')}}');
                });

            </script>
            @endif
            <script>
                function addForm() {
                    document.getElementById('addForm').submit();
                }

            </script>


            @endsection
