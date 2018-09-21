<?php

namespace App\Http\Controllers;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('multipleChoice/addMultipleChoice',compact('quizs_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $question= new Question([
            'number' => $request->get('number'),
            'question' => $request->get('question'),
            'quizs_id' => $request->get('quizs_id'),
            'score' => $request->get('score'),
            'solution' => $request->get('solution'),
            'questions_types_id' => $request->get('questions_types_id'),
            'question_pic_id' => $request->get('question_pic_id'),
          ]);

          $question->save();

          $choice = new Choice ([
            'choice_id' => $request->get('choice_id'),
            'questions_id' => $request->get('questions_id'),
            'choice' => $request->get('choice'),
            'choice_type_id	' => $request->get('choice_type_id'),
          ]);
          
          $choice->save();

          $choiceType = new Choice_type ([
            'choice_type_id	' => $request->get('choice_type_id'),
            'choice' => $request->get('choice'),            
          ]);

          $choiceType->save();

          return redirect()->route('question.index',['quizs_id'=>$request->get('quizs_id')]);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showUploadForms(){
        return view('MultipleChoiceQuestion');
    }
    

    public function storeFiles(request $request){
        
        //return $request-> all();
        $currentQuestionId = DB::table('Questions')->max('questions_id');
        
        $lastestQuestinID = $currentQuestionId+1;


        foreach($request->fileName as $files){

            $fileName =  $files->getClientOriginalName();
            $size =  $files->getClientSize();
            $files->storeAs('public/upload',$fileName);
        

            /*add file into database */
            $QuestionPic = new Question_pictures;
            $QuestionPic ->img_url =$fileName;
            $QuestionPic ->questions_id =$lastestQuestinID;
            $QuestionPic -> save();
            

            //create new message
            $MultipleChoiceQuestion = new Question;
            $MultipleChoice = new Choice;

            $MultipleChoiceQuestion->questions_types_id =$request->input('Multiple');
            $MultipleChoiceQuestion->number =$request->input('number');
            $MultipleChoiceQuestion->solution =$request->input('name');
            $MultipleChoiceQuestion->question =$request->input('question');
            $MultipleChoiceQuestion->score =$request->input('score');

            $MultipleChoice->question_id =$lastestQuestinID;
            $MultipleChoice->choice =$request->input('choice');
            
            //save message
            $MultipleChoiceQuestion->save();
            $MultipleChoice->save();
            return redirect()->route('question.index',['quizs_id'=>$request->get('quizs_id')])->with('success','upload sent') ;
            //return'yes';
            
                

        }
    }  

}
