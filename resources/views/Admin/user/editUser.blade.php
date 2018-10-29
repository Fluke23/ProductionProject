@extends('layouts.main')

@section('content')
<div class="container">

    {{--  breadcrumb --}}
     <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/userManager')}}">User Manager</a></li>
                 <li class="breadcrumb-item">Edit User</a></li>
                </ol>
    </nav>
    {{--  breadcrumb --}}

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit User') }}</div>
                <div class="card-body">
                <form action="{{URL::to('/Admin/user/updateUser')}}" method="post">
                        @csrf

                        {{--  Username  --}}
                         <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ $user->username}}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         {{--  Username  --}}

                        {{--  Remark  --}}
                        <div class="form-group row">
                            <label for="remark" class="col-md-4 col-form-label text-md-right">{{ __('Remark') }}</label>

                            <div class="col-md-6">
                                {{--  <input id="remark" type="text" class="form-control{{ $errors->has('remark') ? ' is-invalid' : '' }}" name="remark" value="{{ $user->remark}}" required autofocus>

                                @if ($errors->has('remark'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('remark') }}</strong>
                                    </span>
                                @endif  --}}
                                    {{Form::select('remark',array('นาย'=>'นาย','นาง'=>'นาง','นางสาว'=>'นางสาว'))}}

                            </div>
                        </div>
                        {{--  Remark  --}}

                        {{--  Firstname  --}}
                         <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('Firstname') }}</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ $user->firstname}}" required autofocus>

                                @if ($errors->has('firstname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         {{--  Firstname  --}}
                       

                        {{--  Lastname  --}}
                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Lastname') }}</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ $user->lastname}}" required autofocus>

                                @if ($errors->has('lastname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{--  Lastname  --}}


                    <input type="hidden" name="id" value="{{ $user->id}}">
                       
                   <div class="modal-footer" >
                      <a href="{{route('userManager.index')}}"><button  class="btn btn-danger">Cancel</button></a>  
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                         
                    </div>
                     
                     
                        
                 </div>  

        </div>
                     
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>




@endsection