<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        $username = Auth::user()->username;

        $user = DB::table('users') //โชว์แค่ข้อมูล user ไม่จำเป็นต้อง join ข้อมูลกับตารางอื่น 
        ->get();

        return view('/Admin/user/index',compact('user'));
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
    public function update(Request $request, $id)
    {
        $permission = $request->get('permission');
        $username = Auth::user()->username;
        
        $id = $request->get('id'); //id sent by editQuiz.blade.php
        $user = User::find($id);
       
        $user->username = $request->get('username');
        $user->remark = $request->get('remark');
        $user->firstname = $request->get('firstname');
        $user->lastname = $request->get('lastname');
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
       

        
            //  return view('/Admin/subject/index',compact('subjects','permission'));
    if($permission == 'ADMIN'){
        return view('Admin/user/viewSubjectUser',compact('subject_user','subject_id','permission'));
    }elseif($permission == 'LECTURER'){
        return view('Lecturer/user/viewSubjectUser',compact('subject_user','subject_id','permission'));
    }
        

        

    }

    public function viewtoSubjectUserDestroy($id)
    {   
        //where because $request sent username it must be  delete id 
        $subject_user  = Subject_user::where('username','=', $id)->delete();  
        return back()->with('success', 'Data Deleted');
        // return view('Admin/user/viewSubjectUser',compact('subject_user'));
    }
    
   

}
