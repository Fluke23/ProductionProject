<?php

namespace App\Http\Controllers;

use App\UploadQuestion;
use App\UploadQuestion1;
use Illuminate\Http\Request;
use DB;
use App\Quiz;

class UploadQuestionController  extends Controller
{
    public function showUploadForms($quiz_id){
        return view('UploadQuestion');
    }
    

    public function storeFiles(request $request){
        
        //return $request-> all();

        $currentQuestionId = DB::table('Questions')->max('questions_id');
        
        $lastestQuestinID = $currentQuestionId+1;
       
        foreach($request->fileName as $files){

            $fileName =  $files->getClientOriginalName();
            $size =  $files->getClientSize();
            $files->storeAs('public/upload',$fileName);
        


            //create new message
           
            $UploadQuestion1 = new UploadQuestion1;
            $UploadQuestion1->Questions_types_id =$request->input('Upload');
            $UploadQuestion1->number =$request->input('number');
            $UploadQuestion1->solution =$request->input('name');
            $UploadQuestion1->question =$request->input('question');
            $UploadQuestion1->score =$request->input('score');
            $UploadQuestion1->quizs_id =$request->input('quiz_id');
            //save message
            $UploadQuestion1->save();

            /*add file into database */
            $UploadQuestion = new UploadQuestion;
            $UploadQuestion ->img_url =$fileName;
            $UploadQuestion ->questions_id =$lastestQuestinID;
            //$UploadQuestion ->size = $size;
            $UploadQuestion -> save();
            
            $quiz_id = $request->input('quiz_id');
            

           
            return redirect()->route('question.index', [$quiz_id]);

            
          
            //return'yes';
            
                

            }

 
        }
        
        
}
  

