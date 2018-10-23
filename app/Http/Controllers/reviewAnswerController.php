<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Question;
use App\Question_pictures;
use App\Quiz;
use App\Answer;
use App\Comment;
use App\Question_type;
use Auth;

class reviewAnswerController extends Controller
{
   

    public function index($questions_id)
    {
        $question = DB::table('Questions')
        ->join('Question_pictures','Question_pictures.questions_id','=','Questions.questions_id')
        ->join('Answer','Answer.questions_id','=','Questions.questions_id')
        ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
        //->join('Comment','Comment.answer_id','=','Answer.answer_id')
        ->where('Questions.questions_id','=',$questions_id)
        ->get();
        //dd($question);
            
        $quizStatus = $question[0]->quizs_status_id;
       // if($permission == 'ADMIN'){
            switch ( $quizStatus) {
                case 'Reviewing':
                return view('/Admin/checkAnswer/reviewAnswer',compact('question','questions_id','question2','quiz_id'));
                    break;
                
                case 'Close':
                return view('/Admin/checkAnswer/commentAnswer',compact('question','questions_id','question2','quiz_id'));
                    break;
            }
    //    $permission = $request->get('permission');
     //   if($permission == 'ADMIN'){
          // return view('/Admin/checkAnswer/reviewAnswer',compact('question','questions_id','question2','quiz_id'));        
      //      }elseif($permission == 'LECTURER'){
       //         return view('/lecturer/checkAnswer/reviewAnswer',compact('question','questions_id','question2','quiz_id'));         
       //     }
       
       // $data = Question::where('questions_id',$questions_id)->get();
        //dd($question);
    }

        public function store(request $request){
            
                        $questions_id= $request->input ('questions_id');
                      // dd($questions_id);
                        $Answer= new Answer;
                        $Answer=$request->input('Score');
                      
                        $Score = DB::table('Answer')
                        ->join('Questions','Questions.questions_id','=','Answer.questions_id')
                        ->where('Answer.questions_id','=',$questions_id)
                        ->update(['Answer.Score'=> $Answer] );

                        $currentAnswerId = DB::table('Answer')->max('answer_id');
                        $lastestAnswerID = $currentAnswerId;

                        $Comment = new Comment;
                        $Comment->answer_id = $lastestAnswerID;
                        $Comment->comment =$request->input('Remark');
                        
                        $username = Auth::user()->username;
                        $Comment->usernames = $username;
                        $Comment->save();
                        
                       // $questions_id = $request->input('questions_id');

                       
                        
                        

                        
                        
                
                       $permission = $request->get('permission');
                       if($permission == 'ADMIN'){
                        return view('/Admin/checkAnswer/indexAnswer',compact($questions_id)); 
                       }elseif($permission == 'LECTURER'){
                        return view('/Lecturer/checkAnswer/indexAnswer',compact($questions_id)); 
                       }
   

           
            //return'yes';
            }
}


