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


class checkScoreController extends Controller
{
   
    public function index(Request $request, $questions_id)
    {
        $question = DB::table('Questions')
        // ->join('Question_pictures','Question_pictures.questions_id','=','Questions.questions_id')
        ->join('Answer','Answer.questions_id','=','Questions.questions_id')
        ->join('Comment','Comment.answer_id','=','Answer.answer_id')
        ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
        ->where('Questions.questions_id','=',$questions_id)
        ->get();

        $data = Question::where('questions_id',$questions_id)->get();
        $questionType = $data[0]->questions_types_id;


        $correct = DB::table('Questions')
        ->join('Choice','Choice.questions_id','=','Questions.questions_id')
        ->join('choice_type','choice_type.choice_type_id','=','Choice.choice_type_id')
        ->join('Answer','Answer.questions_id','=','Questions.questions_id')
        ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
        //->join('Comment','Comment.answer_id','=','Answer.answer_id')
        ->where('Questions.questions_id','=',$questions_id)
        ->where('choice_type.choice_type_id','=','1')
        ->get();
        //dd('test');
        // $permission = $request->get('permission');
        // dd($permission);
        // if($permission == 'ADMIN'){
        //     return view('/Admin/checkAnswer/commentAnswer/',compact('question','questions_id','question2','quiz_id')); 
        //     }elseif($permission == 'STUDENT'){
        //     return view('/Student/checkScore/checkScore/',compact('question','questions_id','question2','quiz_id','test'));
        //     }elseif($permission == 'LECTURER'){
        //     return view('/lecturer/checkAnswer/commentAnswer/',compact('question','questions_id','question2','quiz_id'));          
        //     }
       // $data = Question::where('questions_id',$questions_id)->get();
        //dd($question);
        // dd($question);
        return view('/Student/checkScore/checkScore',compact('question','questions_id','question2','quiz_id','test','questionType','correct'));
    }

    public function indexMultiple($questions_id)
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

        $permission = $request->get('permission');
        if($permission == 'ADMIN'){
                return view('/Admin/checkMultipleAnswer/commentAnswer/',compact('question','questions_id','question2','quiz_id')); 
            }elseif($permission == 'STUDENT'){
                return view('/Student/checkScore/checkScore/',compact('question','questions_id','question2','quiz_id'));       
            }elseif($permission == 'LECTURER'){
                return view('/lecturer/checkMultipleAnswer/commentAnswer/',compact('question','questions_id','question2','quiz_id'));          
            }
    
       }
       
       
    public function store(request $request){
                    $questions_id= $request->input ('questions_id');
                
                    $currentAnswerId = DB::table('Answer')
                    ->select('answer_id')
                    ->join('Questions','Questions.questions_id','=','Answer.questions_id')
                    ->where('Answer.questions_id','=',$questions_id)
                    ->get();
                    $lastestAnswerID = $currentAnswerId[0]->answer_id;
                    $Comment = new Comment;
                    $Comment->answer_id =  $lastestAnswerID;
                    $Comment->comment =$request->input('Remark');
                    
                    $username = Auth::user()->username;
                    $Comment->usernames = $username;
                    $Comment->save();
                    
                
                    
                    

                    
                    
                // $permission = $request->get('permission');
                // return view('/Student/question/StudentQuestion',compact($questions_id,'question'));  
                    return redirect()->back()  ;        
                

    
        //return'yes';
        }




}
