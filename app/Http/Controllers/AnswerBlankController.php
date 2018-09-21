<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Question;
use App\Quiz;

class AnswerBlankController extends Controller
{
    public function index($quizs_id)
    {
       
        $question = DB::table('Questions')
        // ->join('Question_types','Question_types.questions_types_id','=','Questions.questions_types_id')
        
        ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
       // ->join('Answer','Answer.questions_id','=','Questions.questions_id')
       // ->join('Choice','Choice.questions_id','=','Questions.questions_id')
       // ->join('choice_type','choice_type.choice_type_id','=','Choice.choice_type_id')
        ->where('quizs.quizs_id','=',$quizs_id)
        ->get();


        
        
           
            
            return view('/Student/question/AnswerBlankQuestion',compact('question','quizs_id'));       
    }



    public function storeFiles(request $request){
        
                        //create new Answer
                        $AnswerQuestion = new AnswerQuestion;
                        $AnswerQuestion->answer_number =$request->input('1');
                        $AnswerQuestion->answer =$request->input('Answer');
                        $AnswerQuestion->answer_date=$request->input('AnswerDate');
                        $AnswerQuestion->questions_id =$request->input('questions_id');
                        //save message
                        $blankQuestion1->save();
        

            
           
           return redirect()->route('/Student/question/');
            //return'yes';
            }

 
        }
        
        

  



