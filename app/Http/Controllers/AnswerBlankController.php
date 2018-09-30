<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Question;
use App\Question_pictures;
use App\Quiz;
use App\Answer;
use App\Question_type;

class AnswerBlankController extends Controller
{
    
    public function index($questions_id,$quiz_id)
    {
        $question = DB::table('Questions')
        
        ->join('Question_pictures','Question_pictures.questions_id','=','Questions.questions_id')
        ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
        ->where('Questions.questions_id','=',$questions_id)
        ->where('Questions.quizs_id','=',$quiz_id)
        ->get();


        $data = Question::where('questions_id',$questions_id)->get();
        $data2 = Question::where('quizs_id','=',$quiz_id)->get();
        $questionType = $data[0]->questions_types_id;
        


        $question2 = DB::table('Questions')
        
        ->join('Question_pictures','Question_pictures.questions_id','=','Questions.questions_id')
        ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
        ->join('Choice','Choice.questions_id','=','Questions.questions_id')
        ->where('Questions.questions_id','=',$questions_id)
        ->get();


       
        switch ($questionType) {
            case 'Blank':
            return view('/Student/question/AnswerBlankQuestion',compact('question','questions_id','question2','quiz_id'));
                break;
            
            case 'Shortanswe':
            return view('/Student/question/AnswerShortQuestion',compact('question','questions_id','question2','quiz_id'));
                break;  
                
            case 'Upload':
            return view('/Student/question/AnswerUploadQuestion',compact('question','questions_id','question2','quiz_id'));
                break;
                
            case 'True/False':
            return view('/Student/question/AnswerTrueFalseQuestion',compact('question','questions_id','question2','quiz_id'));
                break;        
            
            case 'Multiple':
            return view('/Student/question/AnswerMultipleQuestion',compact('question','questions_id','question2','quiz_id'));
                break;
        }

       
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
        
        

  



