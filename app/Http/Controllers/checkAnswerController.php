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

class checkAnswerController extends Controller
{
    public function index($questions_id)
    {
        $question = DB::table('Questions')
        ->join('Question_pictures','Question_pictures.questions_id','=','Questions.questions_id')
        ->join('Answer','Answer.questions_id','=','Questions.questions_id')
        ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
       // ->join('Comment','Comment.answer_id','=','Answer.answer_id')
        ->where('Questions.questions_id','=',$questions_id)
        ->get();
       
       // dd($question);
        //$permission = $request->get('permission');
        $quizStatus = $question[0]->quizs_status_id;
       // if($permission == 'ADMIN'){
            switch ( $quizStatus) {
                case 'Open':
                return view('/Admin/checkAnswer/indexAnswer',compact('question','questions_id','question2','quiz_id'));
                    break;
                case 'Reviewing':
                return view('/Admin/checkAnswer/indexAnswer',compact('question','questions_id','question2','quiz_id'));
                    break;
                
                case 'Close':
                return view('/Admin/checkAnswer/indexAnswer',compact('question','questions_id','question2','quiz_id'));
                    break;
            }
       // }elseif($permission == 'LECTURER'){
              
       // }
       
        
                
                
               
        
       $data = Question::where('questions_id',$questions_id)->get();
        //dd($question);
    }

       
}
