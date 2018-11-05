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

class answerUploadQuestionController extends Controller
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
          
        if ($request->query('answer') !== null ) {
            $Answer = new Answer();
            $Answer->username = $username;
            $Answer->answer_number =$request->query('input');
            $Answer_file = $request->query('fileName');
                            $input['fileName'] = time().'.'.$Answer_file->getClientOriginalExtension();
                            $filePath = public_path('/images/Photo');
                            $Answer_file->move($filePath,$input['fileName']);
                            $fileName = $input['fileName'];
                        $Answer->answer = '/images/Photo/'.$fileName;
            $Answer->questions_id =$request->query('questions_id');
            //save message
            
            $currentQuestionId = DB::table('Questions')->max('questions_id');
            $lastestQuestinID = $currentQuestionId+1;

            $Answer->save();
        }
    }

        public function store(request $request){
        
                        $username = Auth::user()->username;
                        //create new Answer
                        $Answer = new Answer;
                        $Answer->username = $username;
                        $Answer->answer_number =$request->input('1');
                        $Answer_file = $request->file('fileName');
                            $input['fileName'] = time().'.'.$Answer_file->getClientOriginalExtension();
                            $filePath = public_path('/images/Photo');
                            $Answer_file->move($filePath,$input['fileName']);
                            $fileName = $input['fileName'];
                        $Answer->answer = '/images/Photo/'.$fileName;
                       // $Answer->answer =$request->input('Answer');
                        $Answer->answer_date=$request->input('AnswerDate');
                        $Answer->questions_id =$request->input('questions_id');
                        //save message
                        $Answer->save();
                        $quiz_id = $request->input('quiz_id');
                        $next = Question::where('questions_id','>',$Answer->questions_id)->where('quizs_id',$quiz_id)->orderBy('questions_id')->first();
                        

            
           
                        return redirect()->route('question.StudentQuestion',[$quiz_id]);
            //return'yes';
            }
}

