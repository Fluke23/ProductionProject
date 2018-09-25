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
    
    public function index($questions_id)
    {
    //     $questionType = DB::table('Questions')
    //     ->select('questions_types_id')
    //    //->join('Question_types','Question_types.questions_types_id','=','Questions.questions_types_id')
    //     ->where('questions_id','=',$questions_id)
    //     ->get();

        $data = Question::where('questions_id',$questions_id)->get();
        $questionType = $data[0]->questions_types_id;

        dd($questionType);
        $question = DB::table('Questions')
        // ->join('Question_types','Question_types.questions_types_id','=','Questions.questions_types_id')
        
        ->join('Question_pictures','Question_pictures.questions_id','=','Questions.questions_id')
        ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
        ->where('Questions.questions_id','=',$questions_id)
        ->get();
            
            
        if ($questionType == 'Blank'){
                return view('/Student/question/AnswerBlankQuestion',compact('question','questions_id'));
                }
                else if ($questionType == 'Shortanswe'){
                    return view('/Student/question/AnswerShortQuestion',compact('question','questions_id'));

                    }
                    else if ($questionType == 'Upload'){
                        return view('/Student/question/AnswerUploadQuestion',compact('question','questions_id'));

                    }
                        else if ($questionType == 'True/False'){
                            return view('/Student/question/AnswerUploadQuestion',compact('question','questions_id'));

                        }
                            else{
                            return view('/Student/question/AnswerUploadQuestion',compact('question','questions_id'));
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
        

            
           
           return redirect()->route('/Student/question/', [$quiz_id]);
            //return'yes';
            }

 
        }
        
        

  



