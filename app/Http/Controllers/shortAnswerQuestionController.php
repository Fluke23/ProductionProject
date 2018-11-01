<?php

namespace App\Http\Controllers;

use App\shortAnswerQuestion;
use App\shortAnswerQuestion1;
use Illuminate\Http\Request;
use DB;
use App\Quiz;

class shortAnswerQuestionController extends Controller
{
    public function showUploadForms($quiz_id){
        return view('shortAnswer');
    }
    

    public function storeFiles(request $request){
        
        
           
         $currentQuestionId = DB::table('Questions')->max('questions_id');
        
         $lastestQuestinID = $currentQuestionId+1;
       
       // foreach($request->fileName as $files){

         //   $fileName =  $files->getClientOriginalName();
           // $size =  $files->getClientSize();
            //$files->storeAs('public/upload',$fileName);
        

             //create new message
             $shortAnswerQuestion1 = new shortAnswerQuestion1;
            
             $shortAnswerQuestion1->Questions_types_id =$request->input('Shortanswe');
             $shortAnswerQuestion1->number =$request->input('number');
             $shortAnswerQuestion1->solution =$request->input('name');
             $shortAnswerQuestion1->question =$request->input('question');
             $shortAnswerQuestion1->score =$request->input('score');
             $shortAnswerQuestion1->quizs_id =$request->input('quiz_id');
             //save message
             $shortAnswerQuestion1->save();

            /*add file into database */
            $shortAnswerQuestion = new shortAnswerQuestion;
          
           $shortAnswerQuestionImg =$request->file('fileName');
           if($shortAnswerQuestionImg == NULL){
            $shortAnswerQuestion ->img_url = null;
            $shortAnswerQuestion ->questions_id =$lastestQuestinID;
       
            //$blankQuestion ->size = $size;
            $shortAnswerQuestion -> save();
            $quiz_id = $request->input('quiz_id');
           }else{
            $input['fileName'] = time().'.'.$shortAnswerQuestionImg->getClientOriginalExtension();
            $picPath = public_path('/images/Photo');
            $shortAnswerQuestionImg->move($picPath,$input['fileName']);
            $picName = $input['fileName'];
            $shortAnswerQuestion ->img_url = '/images/Photo/'.$picName;
            $shortAnswerQuestion ->questions_id =$lastestQuestinID;
             
             $shortAnswerQuestion -> save();
             
             $quiz_id = $request->input('quiz_id');
           }
           
            

           
            return redirect()->route('question.index', [$quiz_id]);
          
            //return'yes';
            
                

           // }
           

 
        }
        
        
}
