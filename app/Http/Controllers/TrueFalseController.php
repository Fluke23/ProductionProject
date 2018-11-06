<?php
namespace App\Http\Controllers;
use App\Quiz;
use App\Question;
use App\Question_pictures;
use App\Choice;
use App\Choice_type;
use DB;
use Illuminate\Http\Request;
class TrueFalseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('TrueFalseQuestion/index');
    }
    
    public function showUploadForms($quiz_id){
        return view('admin/question/TrueFalse',compact('quiz_id','amount'));
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
            
            $TrueFalseQuestion = new Question;
            $TrueFalseQuestion->questions_types_id =$request->input('TrueFalse'.$j);
            $TrueFalseQuestion->number =$request->input('number'.$j);
            $TrueFalseQuestion->solution =$request->input('solution'.$j);
            $TrueFalseQuestion->question =$request->input('question'.$j);
            $TrueFalseQuestion->score =$request->input('score'.$j);
            $TrueFalseQuestion->quizs_id =$request->input('quiz_id');
             $quiz_id = $request->input('quiz_id');
            // $TrueFalse->questions_id =$lastestQuestinID;
            $TrueFalseQuestion->questions_id =$lastestQuestinID;
            // for ($i=1; $i <=2 ; $i++){
            // $TrueFalse = new Choice; 
            // $TrueFalse->choice =$request->input('choice_'.$i.$j);
            // $TrueFalse->questions_id =$lastestQuestinID;
            // $TrueFalse->choice_type_id = $request->input('choice_type_id_'.$i.$j);
            $TrueFalseQuestion->save();

            // }

            // dd($request);
            // $question_id = $request->get('questions_id');
            
            //save message
            
            // if($countT == 1 && $countF == 1){
            //     $TrueFalseQuestion->save();
            //     $TrueFalse->save();
                
            // }else{
            //     // return redirect()->route('TrueFalse.add',[$quiz_id])->with('unsuccess','Can not create question'); 
            //     return redirect()->back()->with('unsuccess','Can not create question');
            // }
            //  dd($request->all());
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