<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Question;
use App\Question_pictures;
use App\Quiz;
use App\Answer;
use App\Question_type;
use Auth;
   
class AnswerShortQuestionController extends Controller
{
    public function index($questions_id)
    {
        $question = DB::table('Questions')
        // ->join('Question_types','Question_types.questions_types_id','=','Questions.questions_types_id')
        
        ->join('Question_pictures','Question_pictures.questions_id','=','Questions.questions_id')
        ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
        ->where('Questions.questions_id','=',$questions_id)
        ->get();
            
        $data = Question::where('questions_id',$questions_id)->get();
          
        if ($request->query('answer') !== null ) {
            $Answer = new Answer();
            $Answer->username = $username;
            $Answer->answer_number =$request->query('input');
            $Answer->answer =$request->query('answer');
            $Answer->questions_id =$request->query('questions_id');
            //save message
            
            $currentQuestionId = DB::table('Questions')->max('questions_id');
            $lastestQuestinID = $currentQuestionId+1;

            $Answer->save();
        }
               
    }

        public function store(request $request){
        
                        $username = Auth::user()->username;
                        //create new Answer
                        $Answer = new Answer;
                        $Answer->username = $username;
                        $Answer->answer_number =$request->input('1');
                        $Answer->answer =$request->input('Answer');
                        $Answer->answer_date=$request->input('AnswerDate');
                        $Answer->questions_id =$request->input('questions_id');
                        //save message

                        $Answer->save();
                        $quiz_id = $request->input('quiz_id');
                        $next = Question::where('questions_id','>',$Answer->questions_id)->where('quizs_id',$quiz_id)->orderBy('questions_id')->first();
                        
                        
        

           return redirect()->route('question.StudentQuestion',[$quiz_id]);
            //return'yes';
            }

            public function edit($answer_id)
            {
               $answer = DB::table('Questions')
               ->join('Question_pictures','Question_pictures.questions_id','=','Questions.questions_id')
               ->join('Answer','Answer.questions_id','=','Questions.questions_id')
               ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
               //->join('Comment','Comment.answer_id','=','Answer.answer_id')
               //->where('Questions.questions_id','=',$questions_id)
               ->where('Answer.answer_id','=',$answer_id)
               ->get();
              //dd($question);
                
                return view('/Student/question/editAnswer', compact('answer_id','answer'));
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
        
                $id = $request->get('subject_id_old'); //id sent by editQuiz.blade.php
                
                $subject = Subject::find($id); //หา id เก่า แล้วไปเปลี่ยน 
                $subject->subject_id = $request->get('subject_id');
                $subject->subject_name = $request->get('subject_name');
                $subject->save(); //เซฟ id อันใหม่ที่แก้แล้ว 
        
        
                $quiz = Quiz::where('subject_id','=',$id)  //ต้องไปบันทึกที่ quiz ด้วยเพราะมี subject_id 
                        ->update([  
                            'subject_id' => $request->get('subject_id')
                        ]);
                
                
                $subject_user = Subject_user::where('subject_id','=',$id) // ทำเช่นเดียวกับ quiz 
                        ->update([
                            'subject_id' => $request->get('subject_id')
                        ]);
                
                return redirect()->route('subject.index')->with('success', 'Data Updated');
            }

 
}

