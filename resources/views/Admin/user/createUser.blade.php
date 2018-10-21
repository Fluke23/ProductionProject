@extends('layouts.main')

@section('content')
<div class="container">

    {{--  breadcrumb --}}
     <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/subject')}}">Home</a></li>
                 <li class="breadcrumb-item">Create User</a></li>
                </ol>
    </nav>
    {{--  breadcrumb --}}

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create User') }}</div>
                <div class="card-body">
                <form action="{{URL::to('/Admin/user/saveUser')}}" method="post">
                        @csrf

                         <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- <div class="form-group row">
                            <label for="group_id" class="col-md-4 col-form-label text-md-right">{{ __('group_id') }}</label>

                            <div class="col-md-6">
                                <input id="group_id" type="text" class="form-control{{ $errors->has('group_id') ? ' is-invalid' : '' }}" name="group_id" value="{{ old('group_id') }}" required autofocus>

                                @if ($errors->has('group_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('group_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> --}}
                        
                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('firstname') }}</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ old('firstname') }}" required autofocus>

                                @if ($errors->has('firstname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('lastname') }}</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('lastname') }}" required autofocus>

                                @if ($errors->has('lastname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="remark" class="col-md-4 col-form-label text-md-right">{{ __('remark') }}</label>

                            <div class="col-md-6">
                            {{Form::select('remark', array('นาย'=>'นาย' , 'นาง'=>'นาง','นางสาว'=>'นางสาว'))}}
                                @if ($errors->has('remark'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('remark') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                    <div class="form-group row">
                        <div class="col-md-5 col-form-label text-md-right">
                            <label for="Change_Password">Change Password</label>
                        </div>
                        <div class="col-md-6">
                            <input type="radio" name="Change_Password"
                            <?php if (isset($Change_Password) && $Change_Password=="tres_important") ;?>
                                     value="Y">Yes
                                    <input type="radio" name="Change_Password" checked="checked"
                            <?php if (isset($Change_Password) && $Change_Password=="Change_Password") ;?>
                                     value="N">No
                        </div>   
                    </div>

                   
                   
                     
                     
                         <div class="form-group row">
                            <label for="groups_id" class="col-md-4 col-form-label text-md-right">{{ __('group ') }}</label>
                            {{Form::select('groups_id', array('ADMIN'=>'Admin' , 'LECTURE'=>'Lecturer','STUDENT'=>'Student'))}}
                            
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
                    </form>


                </div>
            </div>
        </div>
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