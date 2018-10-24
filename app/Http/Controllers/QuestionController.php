<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use App\Question;
use App\Quiz;


class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('Admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$quizs_id)
    {
        $permission = $request->get('permission');

        $username = Auth::user()->username;

       $question = DB::table('Questions')
           
            
            ->join('quizs','quizs.quizs_id','=','Questions.quizs_id')
           
            ->where('quizs.quizs_id','=',$quizs_id)
            ->orderby('Questions.questions_id','desc')
            ->get();


        
        
           
            if($permission == 'ADMIN'){
            return view('/Admin/question/index',compact('question','quizs_id'));
            }elseif($permission == 'STUDENT'){
            return view('/Student/question/StudentQuestion',compact('question','quizs_id'));       
            }elseif($permission == 'LECTURER'){       
            return view('/lecturer/question/index',compact('question','quizs_id'));           
            }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function destroy($id,$quizs_id)
    {

        $question_pic =DB::table('Question_pictures')->where('questions_id', '=', $id)->delete();
        $question = Question::find($id);
        $question->delete(); 
        return redirect()->route('question.index',['quizs_id'=>$quizs_id])->with('success', 'Data Deleted');
    }

    public function callBlankQuestion($quiz_id){
        return view('/Admin/question/blankQuestion',compact('quiz_id'));  
    }
    public function callShortAnswerQuesstion($quiz_id){
        return view('/Admin/question/shortAnswer',compact('quiz_id'));  
    }
    public function callUploadFileQuesstion($quiz_id){
        return view('/Admin/question/UploadQuestion',compact('quiz_id'));  
    }

    public function callMultipleChoice(Request $request,$quiz_id){
       //dd($quiz_id);
        // $amount = $request->input('amount');
       // dd($amount);
         $amount = 2;
      return view('/Admin/question/MultipleChoice',compact('quiz_id','amount')); 
    }

    public function callTrueFalse($quiz_id){
        $amount = 5;
        return view('/Admin/question/TrueFalse',compact('quiz_id','amount')); 
    }
}
