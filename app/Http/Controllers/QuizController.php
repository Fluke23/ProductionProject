<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Quiz;
use App\Group_quiz;
use App\Group;
use App\Question;
use App\Quiz_status;
use App\Quiz_type;
use App\Subject_user;
use App\Subject;
use App\User;
use DB;
use Input;
use Config;
use Form;
use Html;

class QuizController extends Controller
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
    public function index(Request $request,$subject_id)
    {
        $permission = $request->get('permission');

        $username = Auth::user()->username;
        $group = Group::all();
        // $quiz_type = Quiz_type::all();
        $quiz_type= DB::table('Quiz_types')->select('quizs_types_id','type_name')->get();
        $quiz_status= DB::table('Quiz_status')->select('quizs_status_id')->get();
        
        // $data = Quiz::all();
        $quizzes = DB::table('quizs')
                ->join('Subjects', 'quizs.subject_id', '=', 'Subjects.subject_id')
                ->join('Quiz_types','Quiz_types.quizs_types_id','=','quizs.quizs_types_id')
                ->join('subjects_user','subjects_user.subject_id','=','Subjects.subject_id')
                ->join('users','users.username','=','subjects_user.username')
                ->join('Quiz_status','Quiz_status.quizs_status_id','=','quizs.quizs_status_id')
                ->join('Groups_quizs','Groups_quizs.quizs_id','=','quizs.quizs_id')
                ->join('Groups','Groups.groups_id','=','Groups_quizs.groups_id')
                ->where('users.username', '=', $username) //ใส่หรือไม่ใส่ก็ได้ 
                ->where('Subjects.subject_id','=',$subject_id)
                ->orderby('quizs.quizs_id','desc') //Addition
                ->get();
        
        
        if($permission == 'ADMIN'){
            return view('/Admin/quiz/quizDetail',compact('quizzes','subject_id','$permission','group','quiz_type','quiz_status'));
        }elseif($permission == 'STUDENT'){
            return view('student/quiz/StudentquizDetail',compact('quizzes','subject_id','$permission','group','quiz_type','quiz_status'));
        }elseif($permission == 'LECTURER'){
            return view('lecturer/quiz/index',compact('quizzes','subject_id','$permission','group','quiz_type','quiz_status'));
        }

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,$subject_id) 
    {
        $permission = $request->get('permission');

        $username = Auth::user()->username;

        $group = Group::all();
        $quiz_type= DB::table('Quiz_types')->select('quizs_types_id','type_name')->get();
        $quiz_status= DB::table('Quiz_status')->select('quizs_status_id')->get();
        if($permission == 'ADMIN'){
        return view('/Admin/quiz/addQuiz',compact('subject_id','group','quiz_type','quiz_status'));
        }elseif($permission == 'LECTURER'){
        return view('/Lecturer/quiz/addQuiz',compact('subject_id','group','quiz_type','quiz_status'));  
        } 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permission = $request->get('permission');

        $username = Auth::user()->username;

          $quiz = new Quiz([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'quiz_date' => $request->get('quiz_date'),
            'subject_id' => $request->get('subject_id'),
            'groups_id' => $request->get('groups_id'),
            'quizs_types_id' => $request->get('quizs_types_id'),
            'quizs_status_id' => $request->get('quizs_status_id'),
          ]);

          $quiz->save();

          $group_quiz = new Group_quiz([
                'quizs_id' =>$quiz->quizs_id, //quiz ใหม่เรื่อยๆ ต้องทำแบบนี้เพื่อให้ข้อมูลเก็บ
                'groups_id' =>$request->get('groups_id')
          ]);

          $group_quiz->save();

        if($permission == 'ADMIN'){
         return redirect()->route('quiz.quizDetail',['subject_id'=>$request->get('subject_id')]);
        }elseif($permission == 'LECTURER'){
        return redirect()->route('lec.quiz.quizDetail',['subject_id'=>$request->get('subject_id')]);
        }
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
        $group = Group::all();
        $quiz_type= DB::table('Quiz_types')->select('quizs_types_id','type_name')->get();
        $quiz_status= DB::table('Quiz_status')->select('quizs_status_id')->get();
        $quiz = Quiz::findorfail($id);
        if($permission == 'ADMIN'){
        return view('admin/quiz/editQuiz', compact('quiz','subject_id','group','quiz_type','quiz_status'));
        }elseif($permission == 'LECTURER'){
        return view('lecturer/quiz/editQuiz', compact('quiz','subject_id','group','quiz_type','quiz_status'));    
        }
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

        $id = $request->get('quiz_id'); //id sent by editQuiz.blade.php
        $quiz = Quiz::find($id);
        $quiz->title = $request->get('title');
        $quiz->description = $request->get('description');
        $quiz->quiz_date = $request->get('quiz_date');
        $quiz->subject_id = $request->get('subject_id');
        $quiz->groups_id = $request->get('groups_id');
        $quiz->quizs_types_id = $request->get('quizs_types_id');
        $quiz->quizs_status_id = $request->get('quizs_status_id');
           
        $quiz->save();
        if($permission == 'ADMIN'){
        return redirect()->route('quiz.quizDetail',['subject_id'=>$subject_id])->with('success', 'Data Deleted');
        }elseif($permission == 'LECTURER'){
        return redirect()->route('lec.quiz.quizDetail',['subject_id'=>$subject_id])->with('success', 'Data Deleted');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id,$subject_id)
    {
        $permission = $request->get('permission');

        $username = Auth::user()->username;

        $quiz = Quiz::find($id);
        $quiz->delete();
        if($permission == 'ADMIN'){
        return redirect()->route('quiz.quizDetail',['subject_id'=>$subject_id])->with('success', 'Data Deleted');
        }elseif($permission == 'LECTURER'){
        return redirect()->route('lec.quiz.quizDetail',['subject_id'=>$subject_id])->with('success', 'Data Deleted');
        }
    }

}

