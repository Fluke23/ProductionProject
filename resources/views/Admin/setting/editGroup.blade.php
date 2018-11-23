@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-3">
            <h2>Edit User Group</h2>
        </div>
        <div class="col-md-9">

        </div>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Edit User Group</li>
        </ol>
    </nav>

<div class="card">
    <div class="card-body">
        <form action="{{URL::to('/Setting/updateGroup/')}}" method="post">
            @csrf

            {{-- groups id --}}
            <div class="form-group row">
                <label for="groups_id" class="col-md-4 col-form-label text-md-right">{{ __('Group ID : ') }}</label>

                <div class="col-md-6">
                    <input id="groups_id" type="text" class="form-control{{ $errors->has('groups_id') ? ' is-invalid' : '' }}"
                        name="groups_id" value="{{$group->groups_id}}" required autofocus readonly>

                    @if ($errors->has('groups_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('groups_id') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
             {{-- groups id --}}


            {{-- group name --}}
            <div class="form-group row">
                <label for="group_name" class="col-md-4 col-form-label text-md-right">{{ __('Group Name : ') }}</label>

                <div class="col-md-6">
                    <input id="group_name" type="text" class="form-control{{ $errors->has('group_name') ? ' is-invalid' : '' }}"
                        name="group_name" value="{{$group->group_name}}" required autofocus>

                    @if ($errors->has('group_name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('group_name') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
             {{-- group name --}}



            <input type="hidden" name="groups_id_old" value="{{ $group->groups_id}}">

             {{--  button  --}}
            <div class="col-md-12 text-center">
                <a class="btn btn-danger mr-2" href="{{url()->previous()}}">Cancel</a>
                <button type="submit" class="btn btn-success px-4">Save</button>
            </div>
            {{--  button  --}}
           

        </form>
    </div>
</div>
    


</div>
@endsection
