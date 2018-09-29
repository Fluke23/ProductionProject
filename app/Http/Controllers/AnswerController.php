<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Question;
use App\Quiz;

class AnswerController extends Controller
{
    
    public function routh(request $request,$quizs_id)
    {

        
       //$question = DB::table('quizs')
       // ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
       // ->where('quizs.quizs_id','=',$quizs_id)
       //->get();

        $question = DB::table('Questions')

        ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
           
        ->where('quizs.quizs_id','=',$quizs_id)
        ->orderby('Questions.questions_id','desc')
        ->get();




       
           return view('/Student/question/StudentQuestion',compact('question','quizs_id'));       
            
    }
}
