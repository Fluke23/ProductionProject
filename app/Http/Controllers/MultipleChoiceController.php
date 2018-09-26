<?php
namespace App\Http\Controllers;
use App\Quiz;
use App\Question;
use App\Question_pictures;
use App\Choice;
use App\Choice_type;
use DB;
use Illuminate\Http\Request;
class MultipleChoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('multipleChoice/index');
    }
    
    public function showUploadForms(){
        return view('MultipleChoiceQuestion');
    }
    
    public function storeFiles(request $request){

        // dd($request);
        
        //return $request-> all();
        for ($j=1; $j <=2 ; $j++) { 
        $currentQuestionId = DB::table('Questions')->max('questions_id');
        
        $lastestQuestinID = $currentQuestionId+1;
        // foreach($request->fileName as $files){
            // $fileName =  $files->getClientOriginalName();
            // $size =  $files->getClientSize();
            // $files->storeAs('public/upload',$fileName);    
                        
            //create new message
            
                
            
            $MultipleChoiceQuestion = new Question;
            $MultipleChoice = new Choice;
            $MultipleChoiceQuestion->questions_types_id =$request->input('Multiple'.$j);
            $MultipleChoiceQuestion->number =$request->input('number'.$j);
            $MultipleChoiceQuestion->solution =$request->input('name'.$j);
            $MultipleChoiceQuestion->question =$request->input('question'.$j);
            $MultipleChoiceQuestion->score =$request->input('score'.$j);
            $MultipleChoiceQuestion->quizs_id =$request->input('quiz_id');
            $MultipleChoiceQuestion->save();
            $MultipleChoice->questions_id =$lastestQuestinID;

            for ($i=1; $i <=4 ; $i++){
            $MultipleChoice = new Choice; 
            $MultipleChoice->choice =$request->input('choice_'.$i.$j);
            $MultipleChoice->questions_id =$lastestQuestinID;
            $MultipleChoice->choice_type_id = $request->input('choice_type_id_'.$i.$j);
            $MultipleChoice->save();
            }
            // dd($request);
            // $question_id = $request->get('questions_id');
            $quiz_id = $request->input('quiz_id');
            //save message
        }

            
             /*add file into database */
            // $QuestionPic = new Question_pictures;
            // $QuestionPic ->img_url =$fileName;
            // $QuestionPic ->questions_id =$lastestQuestinID;
            // $QuestionPic -> save();
            return redirect()->route('question.index',[$quiz_id])->with('success','upload sent') ;
            //return'yes';
            
                
        }
    }