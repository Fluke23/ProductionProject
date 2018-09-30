<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Question;
use App\Question_pictures;
use App\Quiz;
use App\Answer;
use App\Question_type;

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
               
    }

        public function store(request $request){
        
                        //create new Answer
                        $Answer = new Answer;
                        $Answer->answer_number =$request->input('1');
                        $Answer->answer =$request->input('Answer');
                        $Answer->answer_date=$request->input('AnswerDate');
                        $Answer->questions_id =$request->input('questions_id');
                        //save message
                        $Answer->save();
                        
                        $quiz_id = $request->input('quiz_id');
                        
        

           return redirect()->route('question.StudentQuestion',[$quiz_id]);
            //return'yes';
            }

 
}

