<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Question;
use App\Quiz;

class StudentQuestionController extends Controller
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

            foreach ($question as $id) {
                //dd( $questions_id);
                $question_min = DB::table('Questions')
                ->join('quizs','quizs.quizs_id', '=', 'Questions.quizs_id')
                ->join('Answer','Answer.questions_id','=','Questions.questions_id')
                  //->join('subjects_user','subjects_user.subject_id','=','Subjects.subject_id')
                 ->where('Questions.questions_id','=',$id->questions_id)
                 ->min('Answer.Score');
                //->get();
           // dd($question_min);
           $question_max = DB::table('Questions')
                ->join('quizs','quizs.quizs_id', '=', 'Questions.quizs_id')
                ->join('Answer','Answer.questions_id','=','Questions.questions_id')
                  //->join('subjects_user','subjects_user.subject_id','=','Subjects.subject_id')
                 ->where('Questions.questions_id','=',$id->questions_id)
                 ->max('Answer.Score');
     
            $question_avg = DB::table('Questions')
                 ->join('quizs','quizs.quizs_id', '=', 'Questions.quizs_id')
                 ->join('Answer','Answer.questions_id','=','Questions.questions_id')
                   //->join('subjects_user','subjects_user.subject_id','=','Subjects.subject_id')
                  ->where('Questions.questions_id','=',$id->questions_id)
                  ->avg('Answer.Score');

                 
     
             $id->max = $question_max;
             $id->min = $question_min;
             $id->avg = $question_avg;
            }

        
        
           
            
            return view('/Student/question/StudentQuestion',compact('question','quizs_id'));       
    }
    

    public function view($questions_types_id)
    {
        if($questions_types_id == 'Blank'){
            return view('/Student/question/AnswerBlankQuestion');
        }
    }    

}
