<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use App\Question;
use App\Quiz;
use App\Subject;

class StudentQuestionController extends Controller
{
    public function index($quizs_id)
    {       
        $username = Auth::user()->username;


        // dd($username);
        $question = DB::table('Answer')
            ->rightJoin('Questions', 'Questions.questions_id', '=', 'Answer.questions_id')
            ->join('quizs', 'quizs.quizs_id', '=', 'Questions.quizs_id')
            ->where('quizs.quizs_id', '=', $quizs_id)
            ->orderBy('Questions.questions_id')
            ->groupBy('Questions.questions_id')
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

            $quizStatus = DB::table('Questions')
            ->select('quizs_status_id')
            ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
            ->where('Questions.quizs_id','=',$quizs_id)
            ->get();
            
            $subject = DB::table('Subjects')
            ->join('quizs','quizs.subject_id','=','Subjects.subject_id')
            ->where('quizs.quizs_id','=',$quizs_id)
            ->get();


            $questionAnswer = DB::table('Questions')
            // ->join('Question_types','Question_types.questions_types_id','=','Questions.questions_types_id')
            ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
            ->join('Answer','Answer.questions_id','=','Questions.questions_id')
           // ->join('Choice','Choice.questions_id','=','Questions.questions_id')
           // ->join('choice_type','choice_type.choice_type_id','=','Choice.choice_type_id')
            ->where('quizs.quizs_id','=',$quizs_id)
            
            ->get();
            //dd($questionAnswer);
            for($i=0 ;$i<count($quizStatus); $i++){
                if($quizStatus[$i]->quizs_status_id == "Reviewing"){
                    return redirect()->back()->with('unsuccess','Cannot access because Lecturer still reviewing' );
                } else{
                    return view('/Student/question/StudentQuestion',compact('question','quizs_id','quizStatus','questionAnswer','username','subject'));
                }
                $i++;
            }
        
         
            
                   
    }
   
    

    public function view($questions_types_id)
    {
        if($questions_types_id == 'Blank'){
            return view('/Student/question/AnswerBlankQuestion');
        }
    }    

}
