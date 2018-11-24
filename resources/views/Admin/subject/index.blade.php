@extends('layouts.main')

@section('content')
<div class="container">


    <div class="row mb-2">
        <div class="col-md-4">
            <h2>Home(Subject Manager)</h2>
        </div>
        <div class="col-md-8">
            <a href="{{ URL::route('addSubject') }}" class="btn btn-success float-right" data-toggle="modal"
                data-target="#exampleModal">Add Subject</a>
        </div>
    </div>

    @if(Session::has('unsuccess'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Cannot add this Subject becuse this Subject already</strong> {{ Session::get('message', '') }}
    </div>
    @endif

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ URL::to('/Admin/subject')}}">Home</a></li>
        </ol>
    </nav>

    {{-- body --}}
   
        <div class="row">
            <div class="table col-md-12">
            <table id="table">
                <thead>
                    <tr>
                        <th style="width: 150px;">Subject ID</th>
                        <th style="width: 400px;">Subject Name</th>
                        <th>Student</th>
                        <th>Lecturer</th>
                        <th >Option</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($subjects as $key => $subject)
                    <tr>
                        <td>
                            <a href="{{URL::to('/Admin/quiz/'.$subject->subject_id)}}" >{{$subject->subject_id}}</a>
                        </td>

                        <td >{{$subject->subject_name}}</td>

                        <td>{{$subject_user[$key]->studentCount}}</td>

                        <td>{{abs($subject_user2[$key]->allUser - $subject_user[$key]->studentCount)}}</td>

                        <td>
                            <a href="{{URL::to('/Admin/quiz/'.$subject->subject_id)}}" class="btn btn-info ">View</a>

                            <a href="{{URL::to('/Admin/subject/viewSubjectUser/'.$subject->subject_id)}}" class="btn btn-primary ">View user</a>
                            
                           <!-- <a href="{{ URL::to('/Admin/subject/editSubject/'.$subject->subject_id)}}" class="btn btn-warning " data-toggle="modal"
                                data-target="#editSubjectModal1">Edit</a> -->
                            <a href="{{ URL::to('/Admin/subject/editSubject/'.$subject->subject_id)}}" class="btn btn-warning">Edit</a>
                            <a href="{{ URL::to('/Admin/subject/deleteSubject/'.$subject->subject_id)}}" class="btn btn-danger" onclick="return ConfirmDelete();">Delete</a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>

               
            <hr>  
        </div>   
    </div>
    



   {{--  modal add Subject   --}}

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Add Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div >
                        <form action="{{URL::to('/Admin/subject/saveSubject')}}" method="post" id="addForm">
                            @csrf

                            {{-- subject id --}}
                            <div class="form-group ">
                                <label for="subject_id" class="col-md-6 col-form-label text-md-left">{{ __('Subject
                                    ID : ') }}</label>

                                <div class="col-md-6">
                                    <input id="subject_id" type="text" class="form-control{{ $errors->has('subject_id') ? ' is-invalid' : '' }}"
                                        name="subject_id" value="{{ old('subject_id') }}" required autofocus>

                                    @if ($errors->has('subject_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('subject_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{-- subject name --}}
                            <div class="form-group">
                                <label for="subject_name" class="col-md-6 col-form-label text-md-left">{{ __('Subject
                                    Name : ') }}</label>

                                <div class="col-md-12">
                                    <input id="subject_name" type="text" class="form-control{{ $errors->has('subject_name') ? ' is-invalid' : '' }}"
                                        name="subject_name" value="{{ old('subject_name') }}" required autofocus>

                                    @if ($errors->has('subject_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('subject_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="modal-footer mt-4 text-center">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-success" data-dismiss="modal" class="form action" onclick='addForm()'>Add Subject </button>
                            </div>

                        </form>
                </div>
            </div>



        </div>
         {{--  Modal content  --}}
    </div>
    {{--  Modal dialog  --}}
      
</div>
  {{--  modal add Subject   --}}

   {{--  modal edit Subject   --}}
    <div class="modal fade" id="editSubjectModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Edit Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="row">
                    <form action="{{URL::to('/Admin/subject/updateSubject')}}" method="post">
                        @csrf

                        {{-- subject id --}}
                        <div class="form-group row">
                            <label for="subject_id" class="col-md-6 col-form-label text-md-right">{{ __('subject id')
                                }}</label>

                            <div class="col-md-6">
                                <input id="subject_id" type="text" class="form-control{{ $errors->has('subject_id') ? ' is-invalid' : '' }}"
                                    name="subject_id" value='{{$subject->subject_id}}'required autofocus readonly>

                                @if ($errors->has('subject_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('subject_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        {{-- subject name --}}
                        <div class="form-group row">
                            <label for="subject_name" class="col-md-6 col-form-label text-md-right">{{
                                __('subject name') }}</label>

                            <div class="col-md-6">
                                <input id="subject_name" type="text" class="form-control{{ $errors->has('subject_name') ? ' is-invalid' : '' }}"
                                    name="subject_name" value="{{$subject->subject_name}}" required autofocus>

                                @if ($errors->has('subject_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('subject_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                </div>

                    <div class="modal-footer">
                        <input type="hidden" name="subject_id_old" value="{{ $subject->subject_id}}">

                        <button type="reset" class="btn btn-danger">ยกเลิก</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
                    </div>
            </div>
            </form>
        </div>
        <script>
            function addForm() {
                document.getElementById('addForm').submit();
            }

        </script>

        {{--  JavaScript  --}}
    <script>
        function ConfirmDelete()
        {
        var x = confirm("Are you sure you want to delete?");
        if (x)
            return true;
        else
            return false;
        }
    </script>  
{{--  JavaScript  --}}

       
    @endsection
