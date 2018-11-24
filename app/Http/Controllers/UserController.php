<?php

namespace App\Http\Controllers;
use App\Group; 
use App\Users;
use App\User;
use App\Subject;
use App\Subject_user;
use DB;
use Auth;
use App\Student_group;
use App\Group_user;
use App\CsvData;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input as input;
use Maatwebsite\Excel\Facades\Excel;


class UserController extends Controller
{
    public function __construct()
    {
         $this->middleware('Admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $permission = $request->get('permission');

        $username = Auth::user()->username;

       // $user = DB::table('users') //โชว์แค่ข้อมูล user ไม่จำเป็นต้อง join ข้อมูลกับตารางอื่น 
        //->get();
        $user = DB::table('users')
        ->join('Group_user','Group_user.username','=','users.username')
        ->join('Groups','Groups.groups_id','=','Group_user.groups_id')
        ->get();

        $group = DB::table('Groups')->get();
    

        // return view('/Admin/user/index',compact('user','group'));
        if ($permission == 'ADMIN') {
            return view('/Admin/user/index',compact('user','username','group'));
        } elseif ($permission == 'LECTUTER') {
            return back();
        } elseif ($permission == 'STUDENT') {
            return back();
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //ดึงข้อมูลของแต่ละตารางออกมาโข์ที่หน้า addUser.php 
        $subject = DB::table('Subjects')->select('subject_id','subject_name')->get();
        $student_group = DB::table('Student_group')->select('student_group_id','student_group_name')->get();
        $user = DB::table('users')->select('username')->orderBy('username','ASC')->get();
     
        return view('/Admin/user/addGroupUser',compact('subject','student_group','user'));  //mean add subject group user 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            
        //เวลาเก็บข้อมูลลงแต่ละตาราง ให้เก็บแยก ตาม name="" ในหน้า adduser 
        $first_student = $request->user;
        $last_student = $request->user2;
        $subject_id = $request->subject;
        //
        // $student_group_id = $request->student_group;

        //เก็บข้อมูลระหว่าง ตัวและและตัวสุดท้าย นับตัวแรกและตัวสุดท้ายด้วย 
        $query = DB::table('users')->select('username')->whereBetween('username',[$first_student,$last_student])->get();

        // วนข้อมูลเก็บทีละคนผ่าน foreach 
        foreach($query as $student){
            Subject_user::insert([
                'subject_id'=> $subject_id,
                'username'=> $student->username, 
                'student_group_id'=> $request->student_group,
                // 'student_group_id'=> $student_group_id,
            ]);
        }
        
        // return redirect()->route('userManager.index',['users'=>$request->get('users')]);
        return redirect()->route('userManager.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $permission = $request->get('permission');
        $username = Auth::user()->username;
        // $remark= DB::table('Name_title')->select('name_title')->get();
        
    
        
        $user = DB::table('users')->where('username','=',$id)->first();
        


        return view('/Admin/user/editUser',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $permission = $request->get('permission');
        $username = Auth::user()->username;
        
        $id = $request->get('id'); //id sent by editQuiz.blade.php
        $user = User::find($id);
       
        $user->username = $request->get('username');
        $user->remark = $request->get('remark');
        $user->firstname = $request->get('firstname');
        $user->lastname = $request->get('lastname');
        $user->status_banned = $request->get('status_banned');
        $user->save();
        

        return redirect()->route('userManager.index')->with('success', 'Data Edited');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //where because $request sent username it must be  delete id 
        $user = Users::where('username', '=', $id)->delete();

    
        $subject_user  = Subject_user::where('username','=', $id)->delete();
 

        return redirect()->route('userManager.index')->with('success', 'Data Deleted');

    }

    public function destroyMultiple(Request $request)
    {
        //where because $request sent username it must be  delete id 

        if(isset($_POST['deleteMultiple'])){
            $delete = $_POST['deleteMultiple'];
            foreach($delete as $deleteMultiple){
                $user = Users::where('username', '=', $deleteMultiple)->delete();
                $subject_user  = Subject_user::where('username','=', $deleteMultiple)->delete();
            }
        }
        

    
        
 

        return redirect()->route('userManager.index')->with('success', 'Data Deleted');

    }


    public function viewStudent($username)
    {
        $subject_user = DB::table('subjects_user')
        ->join('users','users.username','=','subjects_user.username')
        //
        ->join('Subjects','Subjects.subject_id','=','subjects_user.subject_id')
        //
        ->join('Student_group','Student_group.student_group_id','=','subjects_user.student_group_id')
        ->where('users.username','=',$username)
        ->get();     
        
        // dd($subject_user);

        return view('/Admin/user/viewUserInfo',compact('subject_user','username'));
    }





    //Add User to Group Admin/Lecturer/Student
    public function createTypeGroupUser()
    {

    
    // $subject = DB::table('Subjects')->select('subject_id','subject_name')->get();
    // $student_group = DB::table('Student_group')->select('student_group_id','student_group_name')->get();
    $group = DB::table('Groups')->select('groups_id','group_name')->get();
    $group_user = DB::table('Group_user')->select('groups_id','username')->get();
    $user = DB::table('users')->select('username')->orderBy('username','ASC')->get();

    return view('/Admin/user/addTypeGroupUser',compact('group','group_user','user')); 
    }


    public function storeTypeUser(Request $request)
    {

      
    
        $first_student = $request->user;
        $last_student = $request->user2;
        $groups_id= $request->group;
  
        $query = DB::table('users')->select('username')->whereBetween('username',[$first_student,$last_student])->get();

        foreach($query as $group_user){
            Group_user::insert([
            'groups_id'=> $groups_id,
            'username'=> $group_user->username,
            ]);
        }
        return redirect()->route('userManager.index');

    }
    

    public function createUser(){
                return view('/Admin/user/createUser');
    }


   
        public function storeUser(Request $request){
            // dd($request);
             $this->validate($request, [
             'username' => 'required|string|max:255',
             'password' => 'required|string|min:4|confirmed',
             'firstname' => 'required|string|max:255',
             'lastname' => 'required|string|max:255',
             'remark' => 'required|string|max:255',
             ]);
             $user = Users::insert([
             'username' => $request->get('username'),
             'password' => Hash::make($request->get('password')),
             'firstname' => $request->get('firstname'),
             'lastname' => $request->get('lastname'),
             'remark' => $request->get('remark'),
             'passkey' => $request->get('password'),
             ]);
             $group_user = Group_user::insert([
                 'username' => $request->get('username'),
                 'groups_id'=> $request->get('groups_id')
                 ]);
             $username = $request->get('username');
             return back()->with('success','Create '.$username.' Successful ');
     }

    

     // Import File 
     public function importFileUser(){
        return view('/Admin/user/importUserFile');
    }

    public function parseImport(Request $request)
    {

      
        $path = $request->file('csv_file')->getRealPath();
            if ($request->has('header')) {
                $data = Excel::load($path, function($reader) {})->get()->toArray();
            } else {
                $data = array_map('str_getcsv', file($path));
            }

            foreach($data as $key=>$val){
            
                $user = Users::insert([
                    'username' => $val['username'],
                    'password' => Hash::make($val['password']),
                    'firstname' => $val['firstname'],
                    'lastname' => $val['lastname'],
                    'remark' => $val['remark'],
                    'passkey' => $val['password'],
                ]);

                $group_user = Group_user::insert([
                    'username' => $val['username'],
                    'groups_id' => $val['groups_id'],
                ]);

            }
            



            if (count($data) > 0) {
                if ($request->has('header')) {
                    $csv_header_fields = [];
                        foreach ($data[0] as $key => $value) {
                                 $csv_header_fields[] = $key;
                        }
                }
                // $csv_data = array_slice($data, 0, 2);
                $csv_data_file = CsvData::create([
                        'csv_filename' => $request->file('csv_file')->getClientOriginalName(),
                        'csv_header' => $request->has('header'),
                        'csv_data' => json_encode($data)
                ]);
            } else {
                    return redirect()->back();
            }


                    // return view('import_fields', compact( 'csv_header_fields', 'csv_data', 'csv_data_file'));
        return view('/Admin/user/importShowFile',compact('data'))->with('success', 'Import File Successfil');
    }

    public function viewtoSubjectUser(Request $request,$subject_id)
    {
       
       
        $permission = $request->get('permission');
    
        
        $subject_user = DB::table('subjects_user')
        ->join('users','users.username','=','subjects_user.username')
        //
        ->join('Subjects','Subjects.subject_id','=','subjects_user.subject_id')
        //
        ->join('Group_user','Group_user.username','=','users.username')
        ->join('Student_group','Student_group.student_group_id','=','subjects_user.student_group_id')
        // ->join('Group_user','Group_user.username','=','users.username')
        ->where('Subjects.subject_id','=',$subject_id)
        ->get();

        // for show subject name in view vuewSubjectUser.blade.php
        $subject = Db::table('Subjects')
        ->select('Subjects.subject_name')
        ->where('Subjects.subject_id','=',$subject_id)
        ->get();
        $subjectName = $subject[0]->subject_name;
        // for show subject name in view vuewSubjectUser.blade.php
        $group = DB::table('Groups')->get();
       
        

        
            //  return view('/Admin/subject/index',compact('subjects','permission'));
    if($permission == 'ADMIN'){
        return view('Admin/user/viewSubjectUser',compact('subject_user','subject_id','permission','group','subject','subjectName'));
    }elseif($permission == 'LECTURER'){
return view('Lecturer/user/viewSubjectUser',compact('subject_user','subject_id','permission','group','subject','subjectName'));
    }
        

        

    }


    public function viewtoSubjectUserDestroy($id)
    {   
        //where because $request sent username it must be  delete id 
        $subject_user  = Subject_user::where('username','=', $id)->delete();  
        return back()->with('success', 'Data Deleted');
        // return view('Admin/user/viewSubjectUser',compact('subject_user'));
    }

    public function ExportContactSubjectUser(Request $request,$subject_id){
        
        $subject_user_data = DB::table('subjects_user')
        ->select('Group_user.groups_id','users.username','users.firstname','users.lastname')
        ->join('users','users.username','=','subjects_user.username')
        ->join('Subjects','Subjects.subject_id','=','subjects_user.subject_id')
        ->join('Group_user','Group_user.username','=','users.username')
        ->join('Student_group','Student_group.student_group_id','=','subjects_user.student_group_id')
        // ->join('Group_user','Group_user.username','=','users.username')
        ->where('Subjects.subject_id','=',$subject_id)
        ->orderBy('Group_user.groups_id', 'asc')
        ->get();

        $subject_user_array[] = array('Username', 'Firstname', 'Lastname','User Group');
        foreach($subject_user_data as $su_data){
        $subject_user_array[] = array(
        'Username' => $su_data->username,
        'Firstname' => $su_data->firstname,
        'Lastname' => $su_data->lastname,
        'User Group' => $su_data->groups_id,
        );
        }

        $subject = DB::table('Subjects')
        ->where('Subjects.subject_id','=',$subject_id)
        ->get();

        $subject_id = $subject[0]->subject_id;
        $subject_name = $subject[0]->subject_name;


            Excel::create('List User', function ($excel) use ($subject_user_array,$subject_id, $subject_name) {
            $excel->setTitle('List User');
            $excel->sheet('List User', function ($sheet) use ($subject_user_array,$subject_id, $subject_name) {
            $sheet->fromArray($subject_user_array, null, 'A1', false, false);
            $sheet->setCellValue('F1', 'Subject ID');
            $sheet->setCellValue('G1', 'Subject Name');

            $sheet->setCellValue('F2', $subject_id);
            $sheet->setCellValue('G2', $subject_name);

        });
        })->download('xlsx');

    }
    public function showScoreQuiz(Request $request, $subject_id){
        $permission = $request->get('permission');

        $username = Auth::user()->username;
        $group = Group::all();
        // $quiz_type = Quiz_type::all();
        $quiz_type = DB::table('Quiz_types')->select('quizs_types_id', 'type_name')->get();
        $quiz_status = DB::table('Quiz_status')->select('quizs_status_id')->get();
        $quiz_group = DB::table('Student_group')->select('student_group_name')->get();

        $quizzes = DB::table('quizs')
            ->join('Subjects', 'quizs.subject_id', '=', 'Subjects.subject_id')
            ->join('Quiz_types', 'Quiz_types.quizs_types_id', '=', 'quizs.quizs_types_id')
            ->join('subjects_user', 'subjects_user.subject_id', '=', 'Subjects.subject_id')
            ->join('users', 'users.username', '=', 'subjects_user.username')
            ->join('Quiz_status', 'Quiz_status.quizs_status_id', '=', 'quizs.quizs_status_id')
            ->join('Groups_quizs', 'Groups_quizs.quizs_id', '=', 'quizs.quizs_id')
            ->join('Groups', 'Groups.groups_id', '=', 'Groups_quizs.groups_id')
            ->where('users.username', '=', $username) //ใส่หรือไม่ใส่ก็ได้
            ->where('Subjects.subject_id', '=', $subject_id)
            ->orderby('quizs.quizs_id', 'desc') //Addition
            // ->get();
            ->get();



        foreach ($quizzes as $id) {
        $quiz_min = DB::table('Questions')
            ->join('quizs', 'quizs.quizs_id', '=', 'Questions.quizs_id')
            ->join('Answer', 'Answer.questions_id', '=', 'Questions.questions_id')
            ->where('quizs.quizs_id', '=', $id->quizs_id)
            ->min('Answer.Score');

        $quiz_max = DB::table('Questions')
            ->join('quizs', 'quizs.quizs_id', '=', 'Questions.quizs_id')
            ->join('Answer', 'Answer.questions_id', '=', 'Questions.questions_id')
            ->where('quizs.quizs_id', '=', $id->quizs_id)
            ->max('Answer.Score');

        $quiz_avg = DB::table('Questions')
            ->join('quizs', 'quizs.quizs_id', '=', 'Questions.quizs_id')
            ->join('Answer', 'Answer.questions_id', '=', 'Questions.questions_id')
            ->where('quizs.quizs_id', '=', $id->quizs_id)
            ->avg('Answer.Score');

        $id->max = $quiz_max;
        $id->min = $quiz_min;
        $id->avg = $quiz_avg;
        }

        $quiz_type = DB::table('Quiz_types')->get();

        $subject = DB::table('Subjects')
        ->where('Subjects.subject_id','=',$subject_id)->get();
        // $quizs_id=$quiz_id[2]->quizs_id;

        //dd($quiz_avg);
        // $data = Quiz::all();

        if ($permission == 'ADMIN') {
            return view('/Admin/user/showScoreQuiz', compact('quizzes', 'subject_id', '$permission', 'group', 'quiz_type',
        'quiz_status', 'quiz_group'));
        } elseif ($permission == 'STUDENT') {
            return view('Student/quiz/StudentquizDetail', compact('quizzes', 'subject_id', '$permission', 'group', 'quiz_type',
        'quiz_status', 'quiz_group'));
        } elseif ($permission == 'LECTURER') {
            return view('lecturer/quiz/index', compact('quizzes', 'subject_id', '$permission', 'group', 'quiz_type', 'quiz_status',
        'quiz_group'));
        }
    }



    public function showScoreUser(Request $request, $quizs_id){

            $permission = $request->get('permission');
            // $username = Auth::user()->username;

            $question = DB::table('Questions')
            ->join('quizs', 'quizs.quizs_id', '=', 'Questions.quizs_id')
            ->where('quizs.quizs_id', '=', $quizs_id)
            ->orderby('Questions.number', 'Asc')
            ->get();

            $quiz = DB::table('quizs')
            ->join('Subjects', 'quizs.subject_id', '=', 'Subjects.subject_id')
            ->join('Quiz_types', 'Quiz_types.quizs_types_id', '=', 'quizs.quizs_types_id')
            ->join('Quiz_status', 'Quiz_status.quizs_status_id', '=', 'quizs.quizs_status_id')
            ->where('quizs.quizs_id', '=', $quizs_id)
            ->get();
        
            // Max Score in each Quiz
            $max = DB::table('Answer')
            ->select(DB::raw('SUM(Answer.Score) AS maxScore,users.username'))
            ->join('users', 'users.username', '=', 'Answer.username')
            ->join('Questions', 'Questions.questions_id', '=', 'Answer.questions_id')
            ->join('quizs', 'quizs.quizs_id', '=', 'Questions.quizs_id')
            ->where('quizs.quizs_id', '=', $quizs_id)
            ->groupBy('users.username')
            ->get()->max();
            // Max Score in each Quiz


            // Min Score in each Quiz
            $min = DB::table('Answer')
            ->select(DB::raw('SUM(Answer.Score) AS minScore,users.username'))
            ->join('users', 'users.username', '=', 'Answer.username')
            ->join('Questions', 'Questions.questions_id', '=', 'Answer.questions_id')
            ->join('quizs', 'quizs.quizs_id', '=', 'Questions.quizs_id')
            ->where('quizs.quizs_id', '=', $quizs_id)
            ->groupBy('users.username')
            ->get()->min();
            // Min Score in each Quiz


            //Avg Score in each Quiz
            $sum = DB::table('Answer')
            ->select(DB::raw('SUM(Answer.Score) AS avgScore'))
            ->join('users', 'users.username', '=', 'Answer.username')
            ->join('Questions', 'Questions.questions_id', '=', 'Answer.questions_id')
            ->join('quizs', 'quizs.quizs_id', '=', 'Questions.quizs_id')
            ->where('quizs.quizs_id', '=', $quizs_id)
            ->get();

            $count = DB::table('users')
            ->select(DB::raw('users.username'))
            ->join('Answer', 'users.username', '=', 'Answer.username')
            ->join('Questions', 'Questions.questions_id', '=', 'Answer.questions_id')
            ->join('quizs', 'quizs.quizs_id', '=', 'Questions.quizs_id')
            ->where('quizs.quizs_id', '=', $quizs_id)
            ->groupBy('users.username')
            ->get()->count();
            //Avg Score in each Quiz

            $sum_score = $sum[0]->avgScore;
            $avg_score = $sum_score/$count;

            $max_score = $max->maxScore;
            $min_score = $min->minScore;
            // $avg_score = $avg->avgScore;s

            $total_score = DB::table('Questions')
            ->select(DB::raw('SUM(Questions.score) AS totalScore'))
            ->join('quizs', 'quizs.quizs_id', '=', 'Questions.quizs_id')
            ->where('quizs.quizs_id', '=', $quizs_id)
            ->get();

            $quiz_total = $total_score[0]->totalScore;

         // For generate each user and each score
        $user = DB::table('Answer')
            ->select(DB::raw('SUM(Answer.Score) AS Score, users.username, users.firstname,users.lastname'))
            ->join('users', 'users.username', '=', 'Answer.username')
            ->join('Questions', 'Questions.questions_id', '=', 'Answer.questions_id')
            ->join('quizs', 'quizs.quizs_id', '=', 'Questions.quizs_id')
            ->where('quizs.quizs_id', '=', $quizs_id)
            ->groupBy('users.username','users.firstname','users.lastname')
            ->get();
        // For generate each user and each score
       
        if ($permission == 'ADMIN') {
return view('/Admin/user/showScoreUser',compact('user','quiz','avg_score','max_score','min_score','quiz_total','quizs_id'));
        } elseif ($permission == 'STUDENT') {
            return back();
        } elseif ($permission == 'LECTURER') {
            return view('/Admin/user/showScoreUser',compact('user','quiz','avg_score','max_score','min_score','quiz_total','quizs_id'));

        }
        


    }
    public function showUserGroup(Request $request,$groups_id){
        $username = Auth::user()->username;
        $permission = $request->get('permission');

        // $user = DB::table('users') //โชว์แค่ข้อมูล user ไม่จำเป็นต้อง join ข้อมูลกับตารางอื่น
        //->get();
        $user = DB::table('users')
        ->join('Group_user','Group_user.username','=','users.username')
        ->join('Groups','Groups.groups_id','=','Group_user.groups_id')
        ->where('Groups.groups_id','=',$groups_id)
        ->get();

        $group = DB::table('Groups')->get();

        if ($permission == 'ADMIN') {
            return view('/Admin/user/index',compact('user','username','group'));
        } elseif ($permission == 'LECTUTER') {
            return back();
        } elseif ($permission == 'STUDENT') {
            return back();
        }
    
    
    }

     public function destroyUserInfo($subject_user_id)
    {

    //where because $request sent username it must be delete id
    $subject_user = Subject_user::where('subject_user_id','=', $subject_user_id)->delete();

    return redirect()->route('userManager.index')->with('success', 'Data Deleted');

    }

    public function viewUserQuizScore($username,$subject_id){

    // $quizzes = DB::table('quizs')
    // ->join('Subjects', 'quizs.subject_id', '=', 'Subjects.subject_id')
    // ->join('Quiz_types', 'Quiz_types.quizs_types_id', '=', 'quizs.quizs_types_id')
    // ->join('subjects_user', 'subjects_user.subject_id', '=', 'Subjects.subject_id')
    // ->join('users', 'users.username', '=', 'subjects_user.username')
    // ->join('Quiz_status', 'Quiz_status.quizs_status_id', '=', 'quizs.quizs_status_id')
    // ->join('Groups_quizs', 'Groups_quizs.quizs_id', '=', 'quizs.quizs_id')
    // ->join('Groups', 'Groups.groups_id', '=', 'Groups_quizs.groups_id')
    // ->where('users.username', '=', $username) //ใส่หรือไม่ใส่ก็ได้
    // ->where('Subjects.subject_id', '=', $subject_id)
    // ->orderby('quizs.quizs_id', 'desc') //Addition
    // ->get();

        $name = DB::table('users')
        ->where('users.username', '=', $username)
        ->get(); 




        $quizzes = DB::table('users')
            ->join('subjects_user','subjects_user.username','=','users.username')
            ->join('Subjects','Subjects.subject_id','=','subjects_user.subject_id')
            ->join('quizs','quizs.subject_id','=','Subjects.subject_id')
            ->join('Quiz_status', 'Quiz_status.quizs_status_id', '=', 'quizs.quizs_status_id')
            ->join('Quiz_types', 'Quiz_types.quizs_types_id', '=', 'quizs.quizs_types_id')
            ->where('users.username', '=', $username) //ใส่หรือไม่ใส่ก็ได้
            ->where('Subjects.subject_id', '=', $subject_id)
            ->get();
            
        // dd( $user_quiz );

            foreach ($quizzes as $id) {
                $total_score = DB::table('Questions')
                ->select(DB::raw('SUM(Questions.score) AS totalScore'))
                ->join('quizs', 'quizs.quizs_id', '=', 'Questions.quizs_id')
                ->where('quizs.quizs_id', '=', $id->quizs_id)
                ->get();
            
                // For generate each user and each score
                $user = DB::table('Answer')
                ->select(DB::raw('SUM(Answer.Score) AS Score, users.username'))
                ->join('users', 'users.username', '=', 'Answer.username')
                ->join('Questions', 'Questions.questions_id', '=', 'Answer.questions_id')
                ->join('quizs', 'quizs.quizs_id', '=', 'Questions.quizs_id')
                ->where('quizs.quizs_id', '=', $id->quizs_id)
                ->where('users.username', '=', $username)
                ->get();
               
                // For generate each user and each score
                
                // Max Score in each Quiz
                $max = DB::table('Answer')
                ->select(DB::raw('SUM(Answer.Score) AS maxScore,users.username'))
                ->join('users', 'users.username', '=', 'Answer.username')
                ->join('Questions', 'Questions.questions_id', '=', 'Answer.questions_id')
                ->join('quizs', 'quizs.quizs_id', '=', 'Questions.quizs_id')
                ->where('quizs.quizs_id', '=', $id->quizs_id)
                ->groupBy('users.username')
                ->get()->max();
                // Max Score in each Quiz

                // Min Score in each Quiz
                $min = DB::table('Answer')
                ->select(DB::raw('SUM(Answer.Score) AS minScore,users.username'))
                ->join('users', 'users.username', '=', 'Answer.username')
                ->join('Questions', 'Questions.questions_id', '=', 'Answer.questions_id')
                ->join('quizs', 'quizs.quizs_id', '=', 'Questions.quizs_id')
                ->where('quizs.quizs_id', '=', $id->quizs_id)
                ->groupBy('users.username')
                ->get()->min();
                // Min Score in each Quiz
            
                //Avg Score in each Quiz
                $sum = DB::table('Answer')
                ->select(DB::raw('SUM(Answer.Score) AS avgScore'))
                ->join('users', 'users.username', '=', 'Answer.username')
                ->join('Questions', 'Questions.questions_id', '=', 'Answer.questions_id')
                ->join('quizs', 'quizs.quizs_id', '=', 'Questions.quizs_id')
                ->where('quizs.quizs_id', '=', $id->quizs_id)
                ->get();

                $count = DB::table('users')
                ->select(DB::raw('users.username'))
                ->join('Answer', 'users.username', '=', 'Answer.username')
                ->join('Questions', 'Questions.questions_id', '=', 'Answer.questions_id')
                ->join('quizs', 'quizs.quizs_id', '=', 'Questions.quizs_id')
                ->where('quizs.quizs_id', '=', $id->quizs_id)
                ->groupBy('users.username')
                ->get()->count();
                
            
                $user_score = $user[0]->Score;
                $sum_score = $sum[0]->avgScore;
                $avg_score = $sum_score/$count;
                $max_score = $max->maxScore;
                $min_score = $min->minScore;
                $id->max = $max_score;
                $id->min = $min_score;
                $id->avg = $avg_score;
                $id->user_score = $user_score;


            }

       

            return view('/Admin/user/viewUserQuizScore',compact('quizzes','subject_id','$sum_score','$avg_score','$max_score','$min_score','$avg_score','user_score','user','subject_user','name'));


    }

    public function viewtoSubjectUserGroup(Request $request,$subject_id,$groups_id)
        {
           
            $permission = $request->get('permission');
            // $subject_user = DB::table('subjects_user')
            //     ->join('users','users.username','=','subjects_user.username')
            //     ->join('Subjects','Subjects.subject_id','=','subjects_user.subject_id')
            //     ->join('Group_user','Group_user.username','=','users.username')
            //     ->join('Groups','Groups.groups_id','=','Group_user.groups_id')
            //     ->join('Student_group','Student_group.student_group_id','=','subjects_user.student_group_id')
            //     // ->join('Group_user','Group_user.username','=','users.username')
            //     ->where('Subjects.subject_id','=',$subject_id)
            //     ->where('Groups.groups_id','=',$groups_id)
            //     ->get();
             
            $subject_user = DB::table('Subjects')
            ->join('subjects_user','subjects_user.subject_id','=','Subjects.subject_id')
            ->join('users','users.username','=','subjects_user.username')
            ->join('Group_user','Group_user.username','=','users.username')
            ->join('Groups','Groups.groups_id','=','Group_user.groups_id')
            ->where('Subjects.subject_id','=',$subject_id)
            ->where('Groups.groups_id','=',$groups_id)
            ->get();

            // for show subject name in view vuewSubjectUser.blade.php
            $subject = Db::table('Subjects')
            ->select('Subjects.subject_name')
            ->where('Subjects.subject_id','=',$subject_id)
            ->get();
            $subjectName = $subject[0]->subject_name;
            // for show subject name in view vuewSubjectUser.blade.php
         

            $group = DB::table('Groups')
            ->get();

            // return view('/Admin/subject/index',compact('subjects','permission'));
            if($permission == 'ADMIN'){
                return view('Admin/user/viewSubjectUser',compact('subject_user','subject_id','permission'.'groups_id','group','subject','subjectName'));
            }elseif($permission == 'LECTURER'){
                return view('Lecturer/user/viewSubjectUser',compact('subject_user','subject_id','permission','groups_id','group','subject','subjectName'));
            }
        }

    

    
    
   

}
