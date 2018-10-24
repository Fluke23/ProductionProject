@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-4">
            <h2 >Add Group User</h2>
            </div>
            <div class="col-md-8">
                
                </div>   
    </div>
    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/subject')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/userManager')}}">UserManager</a></li>
            </ol>
        </nav>
    <div class="row mt-5">
    <form action="{{URL::route('saveTypeUser')}}" method="post" class="col-md-12">
                {{ csrf_field() }}
                        
                

                <div class="row">
                        <div class="form-group">
                                <label for="sel2">Student Group</label>
                                <select class="form-control" name="group" id="sel2">
                                @foreach($group as $groups)
                                <option value="{{$groups->groups_id}}">{{$groups->group_name}}</option>
                                @endforeach
                                </select>
                        </div>
                </div>

                <div class="row">
                        <div class="col-md-6">
                                <div class="form-group">
                                        <label for="sel3">First Student ID</label>
                                        <select class="form-control" name="user" id="sel3">
                                                @foreach($user as $users)
                                         <option value="{{$users->username}}">{{$users->username}}</option>
                                          @endforeach
                                        </select>
                                </div>
                            </div>   

                            <div class="col-md-6">
                                        <div class="form-group">
                                                <label for="sel4">Last Student ID</label>
                                                <select class="form-control" name="user2" id="sel4">
                                        @foreach($user as $users)
                                                 <option value="{{$users->username}}">{{$users->username}}</option>
                                         @endforeach
                                                </select>
                                        </div>
                        </div>          
                 </div>
                 <button type="reset" class="btn btn-danger">ยกเลิก</button>
                 <button type="submit" class="btn btn-primary "><i class="fa fa-save"></i> บันทึก</button>               

            </form>
    </div>


</div>
@endsection
