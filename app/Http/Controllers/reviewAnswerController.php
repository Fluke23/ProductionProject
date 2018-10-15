<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Question;
use App\Question_pictures;
use App\Quiz;
use App\Answer;
use App\Question_type;

class reviewAnswerController extends Controller
{
   

    public function index($questions_id)
    {
        $question = DB::table('Questions')
        ->join('Question_pictures','Question_pictures.questions_id','=','Questions.questions_id')
        ->join('Answer','Answer.questions_id','=','Questions.questions_id')
        ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
        ->where('Questions.questions_id','=',$questions_id)
        ->get();
            
        return view('/Admin/checkAnswer/reviewAnswer',compact('question','questions_id','question2','quiz_id'));
       // $data = Question::where('questions_id',$questions_id)->get();
        //dd($question);
    }

        public function store(request $request){
            
                        $questions_id= $request->input ('questions_id');
                      // dd($questions_id);
                        $Answer= new Answer;
                        $Answer=$request->input('Score');
                        
                        //$Remark=new Remark;
                        //$Remark=$request->input('Remark');

                       
                        $Score = DB::table('Answer')
                        
                        ->join('Questions','Questions.questions_id','=','Answer.questions_id')
                        ->where('Answer.questions_id','=',$questions_id)
                        ->update(['Answer.Score'=> $Answer] );
                        //dd($Score);
                        //->get();
                        //dd($Answer);
                         
                     //  $Answer->Score =$request->input('Score');
                    //   $Answer1 = DB::table('Answer')
                     //  ->insert('Score')
                     //  ->join('Questions','Questions.questions_id','=','Answer.questions_id')
                     //  ->where('Answer.questions_id','=',$questions_id);
                     //  $Answer1->remark=$request->input('Remark');
                    
                        
                        //save message
                        
                        
        

           return view('/Admin/checkAnswer/indexAnswer',compact($questions_id));
            //return'yes';
            }
}


