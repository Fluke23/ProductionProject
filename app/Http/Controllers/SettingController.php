<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Subject;
use App\Subject_user;
use App\Quiz;
use App\Group;
use App\Quiz_type;
use App\Quiz_status;

use Illuminate\Http\Request;

class SettingController extends Controller
{
        public function __construct()
        {
          $this->middleware('Admin');
        }


    public function index(Request $request)
    {
        $permission = $request->get('permission');
        //ประกาศไว้เพราะ Auth จาก username มาก่อน
        $username = Auth::user()->username;

        $subjects = DB::table('Subjects')
            ->join('subjects_user','subjects_user.subject_id','=','Subjects.subject_id')
            ->join('users','users.username','=','subjects_user.username')
            ->where('users.username', '=', $username)
            ->orderby('Subjects.subject_id','asc')
            ->get();

        $groups = DB::table('Groups')->get();

        $quiz_types = DB::table('Quiz_types')->get();

        $quiz_status = DB::table('Quiz_status')->get();

        $student_group = DB::table('Student_group')->get();


        if($permission == 'ADMIN'){
            return view('Admin/setting/index',compact('permission','username','subjects','groups','quiz_types','quiz_status','student_group'));


        }elseif($permission == 'STUDENT'){
            return Back();
        }elseif($permission == 'LECTURER'){
            return Back();
        }


    }

    // For Subject
    public function storeSubject(Request $request)
    {
        $username = Auth::user()->username;
        $temp = DB::table('Subjects') ->where([
        'subject_id'=>$request->get('subject_id'),
        'subject_name'=>$request->get('subject_name')
        ])->get();

        if(count($temp)===0){
            $subject = Subject::insert([
            'subject_id' => $request->get('subject_id'),
            'subject_name' => $request->get('subject_name')
            ]);

            $subject_user = Subject_user::insert([
            'subject_id' => $request->get('subject_id'),
            'username' => $username
            ]);
            return redirect()->back()->with('successAdd', 'Data Added');
        }else{
            return redirect()->back()->with('unsuccess','Cannot add this subject because this subject already.' );
        }

    }

    public function destroySubject($id)
    {
        $subject = Subject::find($id);
        $subject->delete();

        return back()->with('successDelete', 'Data Deleted');
    }


    public function editSubject($id)
    {
        $subject = DB::table('Subjects')
        ->where('subject_id','=',$id)->first(); 
        return view('/Admin/setting/editSubject', compact('subject'));
    }

    public function updateSubject(Request $request)
    {

        $id = $request->get('subject_id_old');

        $subject = Subject::find($id); 
        $subject->subject_id = $request->get('subject_id');
        $subject->subject_name = $request->get('subject_name');
        $subject->save(); 


        $quiz = Quiz::where('subject_id','=',$id) 
            ->update([
            'subject_id' => $request->get('subject_id')
        ]);

        $subject_user = Subject_user::where('subject_id','=',$id) 
            ->update([
            'subject_id' => $request->get('subject_id')
        ]);

        return redirect()->route('setting')->with('success', 'Data Updated');
    }
    // For Subject


    // For User Group 
    public function storeGroup(Request $request)
    {
        $temp = DB::table('Groups') ->where([
        'groups_id'=>$request->get('groups_id'),
        ])->get();

        if(count($temp)===0){
        $group = Group::insert([
            'groups_id' => $request->get('groups_id'),
            'group_name' => $request->get('group_name'),
        ]);
            return redirect()->back()->with('successAdd','');
        }else{
            return redirect()->back()->with('unsuccess','Cannot add this subject because this subject already.');
        }
       

    }

    public function editGroup($groups_id)
    {
        $group = DB::table('Groups')
        ->where('groups_id','=',$groups_id)->first();
     
        return view('/Admin/setting/editGroup', compact('group'));
    }

    public function updateGroup(Request $request)
    {

    $id = $request->get('groups_id_old');

    $group = Group::find($id);
    $group->groups_id = $request->get('groups_id');
    $group->group_name = $request->get('group_name');
   
    $group->save();

    return redirect()->route('setting')->with('successEdit', '');
    }

    public function destroyGroup($groups_id)
    {
        
        $group = Group::find($groups_id);
        $group->delete();
        return back()->with('successDelete', '');
    }
    // For User Group


    //For Quiz Type
    public function storeQuizType(Request $request)
    {

        $temp = DB::table('Quiz_types') ->where([
        'quizs_types_id'=>$request->get('quizs_types_id'),
        ])->get();

        if(count($temp)===0){
        $quiz_type = Quiz_type::insert([
            'quizs_types_id' => $request->get('quizs_types_id'),
            'type_name' => $request->get('type_name'),

        ]);
            return redirect()->back()->with('successAdd','');
        }else{
            return redirect()->back()->with('unsuccess','');
        }
        
    }
    public function editQuizType($quizs_types_id)
    {
        $quiz_type = DB::table('Quiz_types')
        ->where('quizs_types_id','=',$quizs_types_id)->first();

        return view('/Admin/setting/editQuizType', compact('quiz_type'));
    }

    public function updateQuizType(Request $request)
    {

        $id = $request->get('quizs_types_id_old');

        $quiz_type = Quiz_type::find($id);
        $quiz_type->quizs_types_id = $request->get('quizs_types_id');
        $quiz_type->type_name = $request->get('type_name');
       
        $quiz_type->save();

        return redirect()->route('setting')->with('successEdit', '');
    }

    public function destroyQuizType($quizs_types_id)
    {
        $quiz_type = Quiz_type::find($quizs_types_id);
        $quiz_type->delete();
        return back()->with('successDelete', '');
    }
    //For Quiz Type



    //For Quiz Status
    public function storeQuizStatus(Request $request){

        $temp = DB::table('Quiz_status') ->where([
        'quizs_status_id'=>$request->get('quizs_status_id'),
        ])->get();
        if(count($temp)===0){
            $quiz_status = Quiz_status::insert([
                'quizs_status_id' => $request->get('quizs_status_id'),
                'status_name' => $request->get('status_name'),
               
            ]);
            return redirect()->back()->with('successAdd','');
        }else{
            return redirect()->back()->with('unsuccess','');
        }
        
    }
    
    
    public function editQuizStatus($quizs_status_id)
    {
        $quiz_status = DB::table('Quiz_status')
        ->where('quizs_status_id','=',$quizs_status_id)->first();

        return view('/Admin/setting/editQuizStatus', compact('quiz_status'));
    }

    public function updateQuizStatus(Request $request)
    {
        $id = $request->get('quizs_status_id_old');
        
        $quiz_status = quiz_status::find($id);
       
        $quiz_status->quizs_status_id = $request->get('quizs_status_id');
        $quiz_status->status_name = $request->get('status_name');
      
        $quiz_status->save();

        return redirect()->route('setting')->with('successEdit', '');
    }
    
    public function destroyQuizStatus($quizs_status_id)
    {
        $quiz_status = Quiz_status::find($quizs_status_id);
        $quiz_status->delete();
        return back()->with('successDelete', '');
    }
    //For Quiz Status
    public function indexSubject(Request $request){
        $permission = $request->get('permission');
        //ประกาศไว้เพราะ Auth จาก username มาก่อน
        $username = Auth::user()->username;

        $subjects = DB::table('Subjects')
        ->join('subjects_user','subjects_user.subject_id','=','Subjects.subject_id')
        ->join('users','users.username','=','subjects_user.username')
        ->where('users.username', '=', $username)
        ->orderby('Subjects.subject_id','asc')
        ->get();

      

        if($permission == 'ADMIN'){
        return view('Admin/setting/indexSubject',compact('permission','username','subjects','request'));
        }elseif($permission == 'STUDENT'){
        return Back();
        }elseif($permission == 'LECTURER'){
        return Back();
        }

    }

    public function indexUserGroup(Request $request){
        $permission = $request->get('permission');
        //ประกาศไว้เพราะ Auth จาก username มาก่อน
        $username = Auth::user()->username;

        // $subjects = DB::table('Subjects')
        // ->join('subjects_user','subjects_user.subject_id','=','Subjects.subject_id')
        // ->join('users','users.username','=','subjects_user.username')
        // ->where('users.username', '=', $username)
        // ->orderby('Subjects.subject_id','asc')
        // ->get();

        $groups = DB::table('Groups')->get();


        if($permission == 'ADMIN'){
        return view('Admin/setting/indexUserGroup',compact('permission','username','groups'));
        }elseif($permission == 'STUDENT'){
        return Back();
        }elseif($permission == 'LECTURER'){
        return Back();
        }
    }  

    public function indexQuizType(Request $request){
            $permission = $request->get('permission');
            //ประกาศไว้เพราะ Auth จาก username มาก่อน
            $username = Auth::user()->username;

            $quiz_types = DB::table('Quiz_types')->get();


            if($permission == 'ADMIN'){
                return view('Admin/setting/indexQuizType',compact('permission','username','quiz_types'));
            }elseif($permission == 'STUDENT'){
                return Back();
            }elseif($permission == 'LECTURER'){
                return Back();
            }
    }

    public function indexQuizStatus(Request $request){
        $permission = $request->get('permission');
        //ประกาศไว้เพราะ Auth จาก username มาก่อน
        $username = Auth::user()->username;

        
        $quiz_status = DB::table('Quiz_status')->get();


        if($permission == 'ADMIN'){
            return view('Admin/setting/indexQuizStatus',compact('permission','username','quiz_status'));
        }elseif($permission == 'STUDENT'){
            return Back();
        }elseif($permission == 'LECTURER'){
            return Back();
        }
    }


        // For STUDENT GROUP
    public function storeStudentGroup(Request $request)
    {
        $temp = DB::table('Student_group') ->where([
            'student_group_name'=>$request->get('student_group_name'),
        ])->get();

        if(count($temp)===0){
            $student_group = Student_group::insert([
            'student_group_name' => $request->get('student_group_name'),
        ]);
            return redirect()->back()->with('successAdd','');
        }else{
            return redirect()->back()->with('unsuccess','Cannot add this subject because this subject already.');
        }

    }

    public function editStudentGroup($student_group_id)
    {
    $student_group = DB::table('Student_group')
    ->where('student_group_id','=',$student_group_id)->first();

    return view('/Admin/setting/editStudentGroup', compact('student_group'));
    }

    public function updateStudentGroup(Request $request)
    {
        $id = $request->get('student_group_id_old');
        $student_group = Student_group::find($id);
        $student_group->student_group_name = $request->get('student_group_name');
        $student_group->save();
        return redirect()->route('setting')->with('successEdit', '');
    }

    public function destroyStudentGroup($student_group_id)
    {
        $student_group = Student_group::find($student_group_id);
        $student_group->delete();
        return back()->with('successDelete', '');
    }

    public function indexStudentGroup(Request $request){
        $permission = $request->get('permission');
        //ประกาศไว้เพราะ Auth จาก username มาก่อน
        $username = Auth::user()->username;

        $student_group = DB::table('Student_group')->get();

        if($permission == 'ADMIN'){
            return view('Admin/setting/indexStudentGroup',compact('permission','username','student_group'));
        }elseif($permission == 'STUDENT'){
            return Back();
        }elseif($permission == 'LECTURER'){
            return Back();
        }

    }

        
// For STUDENT GROUP
           

           








    
        

           






}
