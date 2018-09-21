@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-3">
            <h2 >Add Group User</h2>
            </div>
            <div class="col-md-9">
                
                </div>   
    </div>

    <div class="row">
    <form action="{{URL::route('saveUser')}}" method="post" class="col-md-12">
                {{ csrf_field() }}
                        
                <div class="row">
                        <div class="form-group">
                                <label for="sel1">Subject Name</label>
                                <select class="form-control" name="subject" id="sel1">
                                @foreach($subject as $subject)
                                <option value="{{$subject->subject_id}}">{{$subject->subject_name}}</option>
                                  @endforeach
                                </select>
                              </div>
                </div>

                <div class="row">
                        <div class="form-group">
                                <label for="sel2">Student Group</label>
                                <select class="form-control" name="student_group" id="sel2">
                                @foreach($student_group as $student_group)
                                <option value="{{$student_group->student_group_id}}">{{$student_group->student_group_name}}</option>
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
