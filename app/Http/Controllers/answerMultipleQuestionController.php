<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Question;
//use App\Question_pictures;
use App\Quiz;
use App\Answer;
use App\Question_type;
use Auth;

class answerMultipleQuestionController extends Controller
{
    public function index($questions_id)
    {
        $username = Auth::user()->username;
        $question = DB::table('Questions')
        // ->join('Question_types','Question_types.questions_types_id','=','Questions.questions_types_id')
        
        ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
        ->join('Choice','Choice.choice_id','=','Questions.choice_id')
        ->where('Questions.questions_id','=',$questions_id)
        ->get();
        
        if ($request->query('answer') !== null ) {
            $Answer = new Answer();
            $Answer->username = $username;
            $Answer->answer_number =$request->query('input');
            $Answer->answer =$request->query('answer');
            $Answer->questions_id =$request->query('questions_id');
            //save message
            
            $currentQuestionId = DB::table('Questions')->max('questions_id');
            $lastestQuestinID = $currentQuestionId+1;

            $Answer->save();
        }
        
    }

        public function store(request $request){

                        $username = Auth::user()->username;
                        $data = Question::where('questions_id',$request->input('questions_id'))->get();                        
                        $answerRow = $data[0]->answer_row;
                        $question = DB::table('Answer')
                        // ->join('Question_types','Question_types.questions_types_id','=','Questions.questions_types_id')
                        ->join('Choice','Choice.choice_id','=','Answer.choice_id')
                        ->where('Answer.questions_id','=',$request->input('questions_id'))
                        ->get();
                        
                    // for ($i=0; $i < sizeof($request->input('answer')) ; $i++) { 
                    //         //create new Answer
                    //         $Answer = new Answer;
                    //         $Answer->username = $username;
                    //         $Answer->answer_number =$request->input('1');
                    //         $Answer->answer =$request->input('answer')[$i];
                    //         $Answer->answer_date=$request->input('answerDate');
                    //         $Answer->questions_id =$request->input('questions_id');
                    //         $Answer->choice_id =$request->input('choice_id');
                    //         //save message
                    //         $Answer->save();
                    // }
                    
                        //create new Answer
                        $Answer = new Answer;
                        $Answer->username = $username;
                        $Answer->answer_number =$request->input('1');
                        $Answer->answer =$request->input('answer');
                        $Answer->answer_date=$request->input('answerDate');
                        $Answer->questions_id =$request->input('questions_id');
                        $Answer->choice_id =$request->input('choice_id');
                        //save message
                        $Answer->save();
                
                        $quiz_id = $request->input('quiz_id');
                        $next = Question::where('questions_id','>',$Answer->questions_id)->where('quizs_id',$quiz_id)->orderBy('questions_id')->first();
            

            
           
            return redirect()->route('question.StudentQuestion',[$quiz_id]);
            //return'yes';
            }

	public function update(Request $request)
            {
                

                            //create new Answer
                            $answer_id =$request->get('answer_id');
                            $Answer = Answer::find($answer_id);
                            $Answer->answer = $request->get('answer');
                            $Answer->answer_date=$request->get('answerDate');
                            $Answer->choice_id =$request->get('choice_id');
                            //save message
                            $Answer->save();
                            
                    
                        // $next = Question::where('questions_id','>',$Answer->questions_id)->where('quizs_id',$quiz_id)->orderBy('questions_id')->first();
            

            
           
                        return redirect()->back();
            }      		
 
}

