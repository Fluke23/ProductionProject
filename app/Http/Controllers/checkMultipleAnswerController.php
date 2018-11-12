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

class checkMultipleAnswerController extends Controller
{
    public function index($questions_id)
    {
        $question = DB::table('Questions')
        // ->join('Choice','Choice.questions_id','=','Questions.questions_id')
        ->join('Answer','Answer.questions_id','=','Questions.questions_id')
        ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
        //->join('Comment','Comment.answer_id','=','Answer.answer_id')
        ->where('Questions.questions_id','=',$questions_id)
        ->get();
       // dd($question);
        //$permission = $request->get('permission');
        $quizStatus = $question[0]->quizs_status_id;
        $data = Question::where('questions_id',$questions_id)->get();
        $questionType = $data[0]->questions_types_id;
       // if($permission == 'ADMIN'){

        
        $question2 = DB::table('Questions')
        ->join('Choice','Choice.questions_id','=','Questions.questions_id')
        ->join('Answer','Answer.questions_id','=','Questions.questions_id')
        ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
        //->join('Comment','Comment.answer_id','=','Answer.answer_id')
        ->where('Questions.questions_id','=',$questions_id)
        ->get();

        




        switch ($questionType) {
            case 'Blank':
            switch ( $quizStatus) {
                case 'Open':
                return view('/Admin/checkAnswer/indexAnswer',compact('question','questions_id','question2','quiz_id'));
                    break;
                case 'Reviewing':
                return view('/Admin/checkAnswer/indexAnswer',compact('question','questions_id','question2','quiz_id','questionType'));
                    break;
                
                case 'Close':
                return view('/Admin/checkAnswer/indexAnswer',compact('question','questions_id','question2','quiz_id','questionType'));
                    break;
            }
                break;

            case 'Shortanswe':
            switch ( $quizStatus) {
                case 'Open':
                return view('/Admin/checkAnswer/indexAnswer',compact('question','questions_id','question2','quiz_id'));
                    break;
                    case 'Reviewing':
                    return view('/Admin/checkAnswer/indexAnswer',compact('question','questions_id','question2','quiz_id','questionType'));
                        break;
                    
                    case 'Close':
                    return view('/Admin/checkAnswer/indexAnswer',compact('question','questions_id','question2','quiz_id','questionType'));
                        break;
                }
                    break;    

            case 'Upload':
            switch ( $quizStatus) {
                case 'Open':
                return view('/Admin/checkAnswer/indexAnswer',compact('question','questions_id','question2','quiz_id'));
                    break;
                case 'Reviewing':
                return view('/Admin/checkAnswer/indexAnswer',compact('question','questions_id','question2','quiz_id','questionType'));
                    break;
                
                case 'Close':
                return view('/Admin/checkAnswer/indexAnswer',compact('question','questions_id','question2','quiz_id','questionType'));
                    break;
            }
                break;
                            
            case 'TrueFalse':
            switch ( $quizStatus) {
                case 'Open':
                return view('/Admin/checkMultipleAnswer/indexAnswer',compact('question','questions_id','question2','quiz_id'));
                    break;
                case 'Reviewing':
                return view('/Admin/checkMultipleAnswer/indexAnswer',compact('question','questions_id','question2','quiz_id','questionType'));
                    break;
                
                case 'Close':
                return view('/Admin/checkMultipleAnswer/indexAnswer',compact('question','questions_id','question2','quiz_id','questionType'));
                    break;
            }
                break;        
                        
            case 'Multiple':
            switch ( $quizStatus) {
                case 'Open':
                return view('/Admin/checkMultipleAnswer/indexAnswer',compact('question','questions_id','question2','quiz_id'));
                    break;
                case 'Reviewing':
                return view('/Admin/checkMultipleAnswer/indexAnswer',compact('question','questions_id','question2','quiz_id','questionType'));
                    break;
                
                case 'Close':
                return view('/Admin/checkMultipleAnswer/indexAnswer',compact('question','questions_id','question2','quiz_id','questionType'));
                    break;
            }
                break;
            }

            // switch ( $quizStatus) {
            //     case 'Reviewing':
            //     return view('/Admin/checkAnswer/reviewAnswer',compact('question','questions_id','question2','quiz_id'));
            //         break;
                
            //     case 'Close':
            //     return view('/Admin/checkAnswer/commentAnswer',compact('question','questions_id','question2','quiz_id'));
            //         break;
            // }


       // }elseif($permission == 'LECTURER'){
              
       // }
       
        
                
                
               
        
       $data = Question::where('questions_id',$questions_id)->get();
        //dd($question);
    }

       
}
