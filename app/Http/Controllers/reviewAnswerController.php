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

class reviewAnswerController extends Controller
{
   

    
    public function indexreview($answer_id,$quiz_id){
        //dd($answer_id);
        $questions_id= DB::table('Questions')
        ->select('Questions.questions_id')
        ->join('Answer','Answer.questions_id','=','Questions.questions_id')
        ->where('Answer.answer_id','=',$answer_id)
        ->get();
        //dd($questions_id);
        
        $question = DB::table('Questions')
        ->join('Question_pictures','Question_pictures.questions_id','=','Questions.questions_id')
        ->join('Answer','Answer.questions_id','=','Questions.questions_id')
        ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
        //->join('Comment','Comment.answer_id','=','Answer.answer_id')
        //->where('Questions.questions_id','=',$questions_id)
        ->where('Answer.answer_id','=',$answer_id)
        ->get();
       //dd($question);
        
        $questionReview = DB::table('Questions')
        ->join('Question_pictures','Question_pictures.questions_id','=','Questions.questions_id')
        ->join('Answer','Answer.questions_id','=','Questions.questions_id')
        ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
        ->join('Comment','Comment.answer_id','=','Answer.answer_id')
        //->where('Questions.questions_id','=',$questions_id)
        ->where('Answer.answer_id','=',$answer_id)
        ->get();
        
        //dd($question);
        $quizStatus = $question[0]->quizs_status_id;
        $questions_id = $questions_id[0]->questions_id;
        // if($permission == 'ADMIN'){
             switch ( $quizStatus) {
                 case 'Open':
                 return view('/Admin/checkAnswer/reviewAnswer',compact('question','questions_id','question2','quiz_id','questionReview','answer_id'));
                     break;
                 case 'Reviewing':
                 return view('/Admin/checkAnswer/reviewAnswer',compact('question','questions_id','question2','quiz_id','questionReview','answer_id'));
                     break;
                 
                 case 'Close':
                 return view('/Admin/checkAnswer/commentAnswer',compact('question','questions_id','question2','quiz_id','questionReview'));
                     break;
             }
    }
    
   public function indexMultiple($questions_id,$quiz_id)
    {
        $question = DB::table('Questions')
        // ->join('Choice','Choice.questions_id','=','Questions.questions_id')
        ->join('Answer','Answer.questions_id','=','Questions.questions_id')
        ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
       // ->join('Comment','Comment.answer_id','=','Answer.answer_id')
        ->where('Questions.questions_id','=',$questions_id)
        ->get();

        $correct = DB::table('Questions')
        ->join('Choice','Choice.questions_id','=','Questions.questions_id')
        ->join('choice_type','choice_type.choice_type_id','=','Choice.choice_type_id')
        ->join('Answer','Answer.questions_id','=','Questions.questions_id')
        ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
        //->join('Comment','Comment.answer_id','=','Answer.answer_id')
        ->where('Questions.questions_id','=',$questions_id)
        ->where('choice_type.choice_type_id','=','1')
        ->get();

        $question2 = DB::table('Questions')
        // ->join('Choice','Choice.questions_id','=','Questions.questions_id')
        ->join('Answer','Answer.questions_id','=','Questions.questions_id')
        ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
        ->join('Comment','Comment.answer_id','=','Answer.answer_id')
        ->where('Questions.questions_id','=',$questions_id)
        ->get();

        $quizStatus = $question[0]->quizs_status_id;
        $data = Question::where('questions_id',$questions_id)->get();
        $questionType = $data[0]->questions_types_id;
       // if($permission == 'ADMIN'){
        switch ($questionType) {
            case 'Blank':
            switch ( $quizStatus) {
                case 'Reviewing':
                return view('/Admin/checkAnswer/reviewAnswer',compact('question','questions_id','question2','quiz_id','questionType'));
                    break;
                
                case 'Close':
                return view('/Admin/checkAnswer/commentAnswer',compact('question','questions_id','question2','quiz_id','questionType'));
                    break;
            }
                break;

            case 'Shortanswe':
            switch ( $quizStatus) {
                    case 'Reviewing':
                    return view('/Admin/checkAnswer/reviewAnswer',compact('question','questions_id','question2','quiz_id','questionType'));
                        break;
                    
                    case 'Close':
                    return view('/Admin/checkAnswer/commentAnswer',compact('question','questions_id','question2','quiz_id','questionType'));
                        break;
                }
                    break;    

            case 'Upload':
            switch ( $quizStatus) {
                case 'Reviewing':
                return view('/Admin/checkAnswer/reviewAnswer',compact('question','questions_id','question2','quiz_id','questionType'));
                    break;
                
                case 'Close':
                return view('/Admin/checkAnswer/commentAnswer',compact('question','questions_id','question2','quiz_id','questionType'));
                    break;
            }
                break;
                            
            case 'TrueFalse':
            switch ( $quizStatus) {
                case 'Reviewing':
                return view('/Admin/checkMultipleAnswer/reviewAnswer',compact('question','questions_id','question2','quiz_id','questionType','correct'));
                    break;
                
                case 'Close':
                return view('/Admin/checkMultipleAnswer/commentAnswer',compact('question','questions_id','question2','quiz_id','questionType','correct'));
                    break;
            }
                break;        
                        
            case 'Multiple':
            switch ( $quizStatus) {
                case 'Reviewing':
                return view('/Admin/checkMultipleAnswer/reviewAnswer',compact('question','questions_id','question2','quiz_id','questionType','correct'));
                    break;
                
                case 'Close':
                return view('/Admin/checkMultipleAnswer/commentAnswer',compact('question','questions_id','question2','quiz_id','questionType','correct'));
                    break;
            }
                break;
            }
        }


        public function store(request $request){
          //  dd($request);
                        $questions_id= $request->input ('questions_id');
                     //   dd($questions_id);
                       $answer_id=$request->input ('answer_id');
                        $Answer= new Answer;
                        $Answer=$request->input('Score');
                        $user=DB::table('Answer')
                        ->select('username')
                        ->join('Questions','Questions.questions_id','=','Answer.questions_id')
                        ->where('Answer.answer_id','=', $answer_id)
                        ->get();
                        $newuser=$user[0]->username;
                        //dd($newuser);
                      
                        $Score = DB::table('Answer')
                        ->join('Questions','Questions.questions_id','=','Answer.questions_id')
                        ->where('Answer.answer_id','=', $answer_id)
                        ->where('Answer.username','=',$newuser)
                        ->update(['Answer.Score'=> $Answer] );
                        //dd($Score);

                        //$currentAnswerId = DB::table('Answer')->max('answer_id');
                        //$lastestAnswerID = $currentAnswerId;
                        $currentAnswerId = DB::table('Answer')
                        ->select('answer_id')
                        ->join('Questions','Questions.questions_id','=','Answer.questions_id')
                        ->where('Answer.questions_id','=',$questions_id)
                        ->get();
                        $lastestAnswerID = $currentAnswerId[0]->answer_id;
                        //dd($lastestAnswerID);


                        $Comment = new Comment;
                        $Comment->answer_id = $lastestAnswerID;
                        $Comment->comment =$request->input('Remark');
                        
                        $username = Auth::user()->username;
                        $Comment->usernames = $username;
                        $Comment->save();
                        
                       // $questions_id = $request->input('questions_id');
                      
                       $question = DB::table('Questions')
                       ->join('Question_pictures','Question_pictures.questions_id','=','Questions.questions_id')
                       ->join('Answer','Answer.questions_id','=','Questions.questions_id')
                       ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
                       ->join('Comment','Comment.answer_id','=','Answer.answer_id')
                       ->where('Questions.questions_id','=',$questions_id)
                       ->get();
                       
                       
                       
                        

                        
                       return view('/Admin/checkAnswer/indexAnswer',compact('questions_id','question')); 

                     /* $permission = $request->get('permission');
                       if($permission == 'ADMIN'){
                        return view('/Admin/checkAnswer/indexAnswer',compact('questions_id','question')); 
                       }else{
                        return view('/Lecturer/checkAnswer/indexAnswer',compact($questions_id)); 
                       } */ 
   

           
            //return'yes';
            }

            public function storeMultiple(request $request){
            
                $questions_id= $request->input ('questions_id');
              // dd($questions_id);
                $Answer= new Answer;
                $Answer=$request->input('Score');
                $user=DB::table('Answer')
                ->select('username')
                ->join('Questions','Questions.questions_id','=','Answer.questions_id')
                ->where('Answer.questions_id','=',$questions_id)
                ->get();
                $newuser=$user[0]->username;
                //dd($newuser);
              
                $Score = DB::table('Answer')
                ->join('Questions','Questions.questions_id','=','Answer.questions_id')
                ->where('Answer.questions_id','=',$questions_id)
                ->where('Answer.username','=',$newuser)
                ->update(['Answer.Score'=> $Answer] );
                //dd($Score);

                //$currentAnswerId = DB::table('Answer')->max('answer_id');
                //$lastestAnswerID = $currentAnswerId;
                $currentAnswerId = DB::table('Answer')
                ->select('answer_id')
                ->join('Questions','Questions.questions_id','=','Answer.questions_id')
                ->where('Answer.questions_id','=',$questions_id)
                ->get();
                $lastestAnswerID = $currentAnswerId[0]->answer_id;
                //dd($lastestAnswerID);


                $Comment = new Comment;
                $Comment->answer_id = $lastestAnswerID;
                $Comment->comment =$request->input('Remark');
                
                $username = Auth::user()->username;
                $Comment->usernames = $username;
                $Comment->save();
                
               // $questions_id = $request->input('questions_id');
               $question = DB::table('Questions')
               ->join('Answer','Answer.questions_id','=','Questions.questions_id')
               ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
               ->join('Comment','Comment.answer_id','=','Answer.answer_id')
               ->where('Questions.questions_id','=',$questions_id)
               ->get();
               
               
                

                
               return view('/Admin/checkMultipleAnswer/indexAnswer',compact('questions_id','question')); 

             /* $permission = $request->get('permission');
               if($permission == 'ADMIN'){
                return view('/Admin/checkAnswer/indexAnswer',compact('questions_id','question')); 
               }else{
                return view('/Lecturer/checkAnswer/indexAnswer',compact($questions_id)); 
               } */ 


   
    //return'yes';
    }

}


