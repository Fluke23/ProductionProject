<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Question;
use App\Question_pictures;
use App\Quiz;
use App\Answer;
use App\Question_type;
use App\Users;
use Auth;


class AnswerBlankController extends Controller
{
    
    public function index(Request $request,$questions_id,$quiz_id)
    {
        $username = Auth::user()->username;
        
        $answerCheck = DB::table('Answer')
        ->where('username','=',$username)
        ->where('questions_id','=',$questions_id)
        ->get();
       // dd($answerCheck);
        if(count($answerCheck)===0 ){
            
            $question = DB::table('Questions')
            ->join('Question_pictures','Question_pictures.questions_id','=','Questions.questions_id')
            ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
            ->where('Questions.questions_id','=',$questions_id)
            ->where('Questions.quizs_id','=',$quiz_id)
            ->get();
        
                


            $data = Question::where('questions_id',$questions_id)->get();
            $data2 = Question::where('quizs_id','=',$quiz_id)->get();
            $questionType = $data[0]->questions_types_id;
            //dd($questionType);

            $quizStatus = DB::table('Questions')
            ->select('quizs_status_id')
            ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
            ->where('Questions.quizs_id','=',$quiz_id)
            ->get();
            //dd($quizStatus);
        
            $question2 = DB::table('Questions')
            ->join('Question_pictures','Question_pictures.questions_id','=','Questions.questions_id')
            ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
            ->join('Choice','Choice.questions_id','=','Questions.questions_id')
            ->where('Questions.questions_id','=',$questions_id)
            ->get();
            //dd($question2);

            $question3 = DB::table('Questions')
            ->select('Question_pictures.img_url','quizs.title','Questions.solution','Questions.question','Questions.score'
            ,'Questions.number','Answer.username','Answer.answer_date','Answer.answer','Comment.usernames','Comment.created_at','Comment.comment')
            ->join('Question_pictures','Question_pictures.questions_id','=','Questions.questions_id')
            ->join('Answer','Answer.questions_id','=','Questions.questions_id')
            ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
            ->join('Comment','Comment.answer_id','=','Answer.answer_id')
            ->where('Questions.questions_id','=',$questions_id)
            ->get();
       
             //dd($question3);
             $question4 = DB::table('Questions')
             ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
            ->where('Questions.questions_id','=',$questions_id)
            ->where('Questions.quizs_id','=',$quiz_id)
            ->get();

            $question5 = DB::table('Questions')
            ->join('quizs','quizs.quizs_id', '=', 'Questions.quizs_id')
            ->join('Choice','Choice.questions_id','=','Questions.questions_id')
             //->join('subjects_user','subjects_user.subject_id','=','Subjects.subject_id')
            ->where('Questions.questions_id','=',$questions_id)
            ->get();

            $previous = Question::where('questions_id','<',$questions_id)->orderBy('questions_id','desc')->first();
            $next = Question::where('questions_id','>',$questions_id)->orderBy('questions_id')->first();
            $questionMax = Question::select('questions_id')->where('quizs_id',$quiz_id)->max('questions_id');
            $questionMin = Question::select('questions_id')->where('quizs_id',$quiz_id)->min('questions_id');
            $answerRow = $data[0]->answer_row;

            

            // dd($request->all());
            
            if ($request->query('answer') !== null ) {
                if($questionType == 'Multiple'){
                    { 
                        
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
                        }else{
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
                


            for($i=0 ;$i<count($quizStatus); $i++){
                if($quizStatus[$i]->quizs_status_id == "Open"){
                    switch ($questionType) {
                        case 'Blank':
                        return view('/Student/question/AnswerBlankQuestion',compact('question','questions_id','question2','quiz_id','next','questionMax','answerRow','questionType'));
                            break;
                        
                        case 'Shortanswe':
                        return view('/Student/question/AnswerShortQuestion',compact('question','questions_id','question2','quiz_id','next','questionMax','answerRow','questionType'));
                            break;  
                            
                        case 'Upload':
                        return view('/Student/question/AnswerUploadQuestion',compact('question','questions_id','question2','quiz_id','next','questionMax','answerRow','questionType'));
                            break;
                            
                        case 'TrueFalse':
                        return view('/Student/question/AnswerTrueFalseQuestion',compact('question','questions_id','question4','quiz_id','next','question5','questionMax','answerRow','questionType'));
                            break;        
                        
                        case 'Multiple':
                        return view('/Student/question/AnswerMultipleQuestion',compact('question','questions_id','question4','quiz_id','next','question5','questionMax','answerRow','questionType'));
                            break;
                    }
                //}else if($quizStatus[$i]->quizs_status_id == "Reviewing"){
                 //   return redirect()->back()->with('unsuccess','Cannot access because Lecturer still reviewing' );
    
                } else{
                   
                    return view('/Student/checkScore/checkScore',compact('question','questions_id','question2','quiz_id','questionType','$question3'))->with('question',$question3);
                    //return view('/Student/checkScore/checkScore',compact('question','questions_id','question2','question3','quiz_id'));
                }
                $i++;
            }
    
        }else{
            
                     $answerCheck = DB::table('Answer')
                     ->where('username','=',$username)
                     ->where('questions_id','=',$questions_id)
                     ->get();

                    $question = DB::table('Questions')
                    ->join('Question_pictures','Question_pictures.questions_id','=','Questions.questions_id')
                   ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
                   ->where('Questions.questions_id','=',$questions_id)
                   ->where('Questions.quizs_id','=',$quiz_id)
                   ->get();
               
                   if ($request->query('answer') !== null ) {
                    if($questionType == 'Multiple'){
                        for ($i=0; $i < sizeof($request->query('answer')) ; $i++) { 
                            
                            $Answer = new Answer();
                            $Answer->username = $username;
                            $Answer->answer_number =$request->query('input');
                            $Answer->answer =$request->query('answer')[$i];
                            $Answer->questions_id =$request->query('questions_id');
                        //save message
                
                            $currentQuestionId = DB::table('Questions')->max('questions_id');
                            $lastestQuestinID = $currentQuestionId+1;
    
                            $Answer->save();
                        }
                            }else{
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
       
       
                   $data = Question::where('questions_id',$questions_id)->get();
                   $data2 = Question::where('quizs_id','=',$quiz_id)->get();
                   $questionType = $data[0]->questions_types_id;
                   //dd($questionType);
       
                   $quizStatus = DB::table('Questions')
                   ->select('quizs_status_id')
                   ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
                   ->where('Questions.quizs_id','=',$quiz_id)
                   ->get();
                   //dd($quizStatus);
               
                   $question2 = DB::table('Questions')
                   ->join('Question_pictures','Question_pictures.questions_id','=','Questions.questions_id')
                   ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
                   ->join('Choice','Choice.questions_id','=','Questions.questions_id')
                   ->where('Questions.questions_id','=',$questions_id)
                   ->get();
                   //dd($question2);
       
                   $question3 = DB::table('Questions')
                   ->select('Question_pictures.img_url','quizs.title','Questions.solution','Questions.question','Questions.score'
                   ,'Questions.number','Answer.username','Answer.answer_date','Answer.answer','Comment.usernames','Comment.created_at','Comment.comment')
                   ->join('Question_pictures','Question_pictures.questions_id','=','Questions.questions_id')
                   ->join('Answer','Answer.questions_id','=','Questions.questions_id')
                   ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
                   ->join('Comment','Comment.answer_id','=','Answer.answer_id')
                   ->where('Questions.questions_id','=',$questions_id)
                   ->get();
              
                    //dd($question3);
                    $question4 = DB::table('Questions')
                    ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
                   ->where('Questions.questions_id','=',$questions_id)
                   ->where('Questions.quizs_id','=',$quiz_id)
                   ->get();
       
                   $question5 = DB::table('Questions')
                   ->join('quizs','quizs.quizs_id', '=', 'Questions.quizs_id')
                   ->join('Choice','Choice.questions_id','=','Questions.questions_id')
                    //->join('subjects_user','subjects_user.subject_id','=','Subjects.subject_id')
                   ->where('Questions.questions_id','=',$questions_id)
                   ->get();
       
                   $previous = Question::where('questions_id','<',$questions_id)->orderBy('questions_id','desc')->first();
                   $next = Question::where('questions_id','>',$questions_id)->orderBy('questions_id')->first();
                   $questionMax = Question::select('questions_id')->where('quizs_id',$quiz_id)->max('questions_id');
                   $questionMin = Question::select('questions_id')->where('quizs_id',$quiz_id)->min('questions_id');
                   $answerRow = $data[0]->answer_row;

       
                   for($i=0 ;$i<count($quizStatus); $i++){
                       if($quizStatus[$i]->quizs_status_id == "Open"){
                        return redirect()->back()->with('unanswer','You have already answered.' );
                       }else if($quizStatus[$i]->quizs_status_id == "Reviewing"){
                           return redirect()->back()->with('unsuccess','Cannot access because Lecturer still reviewing' );
           
                       } else{
                           return view('/Student/checkScore/checkScore',compact('question','questions_id','question2','quiz_id','questionType','$question3'))->with('question',$question3);
                           //return view('/Student/checkScore/checkScore',compact('question','questions_id','question2','question3','quiz_id'));
                       }
                       $i++;
                   }
           
                   
               
        }
        //dd(count ($answerCheck[0]));
    }


    
    
    public function store(request $request){
        
                    $username = Auth::user()->username;
                    //session ข้องข้อมูลนศ ที่login
                    //dd($username);

                        //create new Answer
                        $Answer = new Answer;
                        $Answer->username = $username;
                        $Answer->answer_number =$request->input('1');
                        $Answer->answer =$request->input('Answer');
                        $Answer->answer_date=$request->input('AnswerDate');
                        $Answer->questions_id =$request->input('questions_id');
                        //save message

                        $currentQuestionId = DB::table('Questions')->max('questions_id');
                        $lastestQuestinID = $currentQuestionId+1;
                        $quiz_id = $request->input('quiz_id');
                        
                        $next = Question::where('questions_id','>',$Answer->questions_id)->where('quizs_id',$quiz_id)->orderBy('questions_id')->first();

                        $Answer->save();

                        $answerback =$request->input('Answer');
        

                        

            
           
                        return redirect()->route('question.StudentQuestion',[$quiz_id]);
            //return'yes';
            }

            public function edit($answer_id)
            {
                //dd($answer_id);
               $answer = DB::table('Questions')
               ->join('Question_pictures','Question_pictures.questions_id','=','Questions.questions_id')
               ->join('Answer','Answer.questions_id','=','Questions.questions_id')
               ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
               //->join('Comment','Comment.answer_id','=','Answer.answer_id')
               //->where('Questions.questions_id','=',$questions_id)
               ->where('Answer.answer_id','=',$answer_id)
               ->get();

               $answer2 = DB::table('Questions')
                //->join('Question_pictures','Question_pictures.questions_id','=','Questions.questions_id')
               ->join('Answer','Answer.questions_id','=','Questions.questions_id')
               ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
               //->join('Comment','Comment.answer_id','=','Answer.answer_id')
               //->where('Questions.questions_id','=',$questions_id)
               ->where('Answer.answer_id','=',$answer_id)
               ->get();

               $answer3 = DB::table('Questions')
                //->join('Question_pictures','Question_pictures.questions_id','=','Questions.questions_id')
               ->join('Answer','Answer.questions_id','=','Questions.questions_id')
               ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
               //->join('Comment','Comment.answer_id','=','Answer.answer_id')
               ->join('Choice','Choice.questions_id','=','Questions.questions_id')
               //->where('Questions.questions_id','=',$questions_id)
               ->where('Answer.answer_id','=',$answer_id)
               ->get();

            //    dd($answer2[0]->questions_types_id);
              //dd($answer);
              for($i=0 ;$i<count($answer2); $i++){
                if($answer2[$i]->questions_types_id == "Blank"){
                    return view('/Student/question/editAnswer', compact('answer_id','answer','previous','next','questionMax','questionMin','answerRow'));
                }else if($answer2[$i]->questions_types_id == "Shortanswe"){
                    return view('/Student/question/editAnswerShort', compact('answer_id','answer','previous','next','questionMax','questionMin','answerRow'));  
                }else if($answer2[$i]->questions_types_id == "Upload"){
                    return view('/Student/question/editAnswerUpload', compact('answer_id','answer','previous','next','questionMax','questionMin','answerRow')); 
                }else if($answer2[$i]->questions_types_id == "Multiple"){
                    
                    return view('/Student/question/editAnswerMultipleQuestion', compact('answer_id','answer','answer3','previous','next','questionMax','questionMin','answerRow'));
                }else if($answer2[$i]->questions_types_id == "TrueFalse"){
                    return view('/Student/question/editAnswerTrueFalseQuestion', compact('answer_id','answer','answer2','previous','next','questionMax','questionMin','answerRow'));
                }
             }
            }

            

            public function update(Request $request)
            {

                 //dd($request);

                $answer_id = $request->get('answer_id');
                $answer = Answer::find($answer_id); 
                $answer->answer = $request->get('answer');
                $quiz_id = $request->input('quiz_id');
                // dd($answer);
                $answer->save(); //เซฟ id อันใหม่ที่แก้แล้ว 

            
               
        
                // return view('/Student/question/StudentQuestion', compact('answer_id','answer'));
                return redirect()->back();
            }   

 
        }
        
        

  



