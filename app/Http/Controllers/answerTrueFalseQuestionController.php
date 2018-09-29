<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Question;
use App\Question_pictures;
use App\Quiz;
use App\Answer;
use App\Question_type;

class answerTrueFalseQuestionController extends Controller
{
    public function index($questions_id)
    {
        $question = DB::table('Questions')
        // ->join('Question_types','Question_types.questions_types_id','=','Questions.questions_types_id')
        
        ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
        ->join('Choice','Choice.choice_id','=','Questions.choice_id')
        ->where('Questions.questions_id','=',$questions_id)
        ->get();
        
        
    }

        public function store(request $request){
        
                        //create new Answer
                        $Answer = new Answer;
                        $Answer->answer_number =$request->input('1');
                        $Answer->answer =$request->input('answer');
                        $Answer->answer_date=$request->input('answerDate');
                        $Answer->questions_id =$request->input('questions_id');
                        $Answer->choice_id =$request->input('choice_id');
                        //save message
                        $Answer->save();
            

            
           
           return redirect()->route('/Student/question/', [$quiz_id]);
            //return'yes';
            }

 
}