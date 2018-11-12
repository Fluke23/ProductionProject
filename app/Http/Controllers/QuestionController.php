<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use App\Question;
use App\Quiz;
use Maatwebsite\Excel\Facades\Excel;


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
            ->orderby('Questions.number','Asc')
            ->get();


       foreach ($question as $id) {
           //dd( $questions_id);
           $question_min = DB::table('Questions')
           ->join('quizs','quizs.quizs_id', '=', 'Questions.quizs_id')
           ->join('Answer','Answer.questions_id','=','Questions.questions_id')
             //->join('subjects_user','subjects_user.subject_id','=','Subjects.subject_id')
            ->where('Questions.questions_id','=',$id->questions_id)
            ->min('Answer.Score');
           //->get();
      // dd($question_min);
      $question_max = DB::table('Questions')
           ->join('quizs','quizs.quizs_id', '=', 'Questions.quizs_id')
           ->join('Answer','Answer.questions_id','=','Questions.questions_id')
             //->join('subjects_user','subjects_user.subject_id','=','Subjects.subject_id')
            ->where('Questions.questions_id','=',$id->questions_id)
            ->max('Answer.Score');

       $question_avg = DB::table('Questions')
            ->join('quizs','quizs.quizs_id', '=', 'Questions.quizs_id')
            ->join('Answer','Answer.questions_id','=','Questions.questions_id')
              //->join('subjects_user','subjects_user.subject_id','=','Subjects.subject_id')
             ->where('Questions.questions_id','=',$id->questions_id)
             ->avg('Answer.Score');

        
    



        $id->max = $question_max;
        $id->min = $question_min;
        $id->avg = $question_avg;
       }

       
        


        
        
           
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
        $amount = 2;
        return view('/Admin/question/TrueFalse',compact('quiz_id','amount')); 
    }
    public function exportScoreQuiz(Request $request, $quizs_id)
    {

        $username = Auth::user()->username;

        $permission = $request->get('permission');
        $quiz_data = DB::table('quizs')
            ->join('Subjects', 'quizs.subject_id', '=', 'Subjects.subject_id')
            ->join('Quiz_types', 'Quiz_types.quizs_types_id', '=', 'quizs.quizs_types_id')
            ->join('subjects_user', 'subjects_user.subject_id', '=', 'Subjects.subject_id')
            ->join('users', 'users.username', '=', 'subjects_user.username')
            ->join('Quiz_status', 'Quiz_status.quizs_status_id', '=', 'quizs.quizs_status_id')
            ->join('Groups_quizs', 'Groups_quizs.quizs_id', '=', 'quizs.quizs_id')
            ->join('Groups', 'Groups.groups_id', '=', 'Groups_quizs.groups_id')
            ->where('users.username', '=', $username) //ใส่หรือไม่ใส่ก็ได้
        // ->where('Subjects.subject_id', '=', $subject_id)
            ->where('quizs.quizs_id', '=', $quizs_id)
            ->orderby('quizs.quizs_id', 'desc')
            ->get()->toArray();

        $quiz_array[] = array('Quiz Name', 'Quiz Description', 'Subject', 'Quiz type', 'Min Score', 'Max Score', 'Avg Score');

        foreach ($quiz_data as $quiz) {
            $quiz_array[] = array(
                'Quiz Name' => $quiz->title,
                'Description' => $quiz->description,
                'Subject' => $quiz->subject_id,
                'Quiz type' => $quiz->type_name,
            );
        }

        //Total Score 
        $total_score = DB::table('Questions')
            ->select(DB::raw('SUM(Questions.score) AS totalScore'))
            ->join('quizs', 'quizs.quizs_id', '=', 'Questions.quizs_id')
            ->where('quizs.quizs_id', '=', $quizs_id)
            ->get();
        //Total Score

        $quiz_name = $quiz->title;
        $quiz_subject = $quiz->subject_id;
        $quiz_total = $total_score[0]->totalScore;
        

        // For generate each user  and each score
        $user = DB::table('Answer')
            ->select(DB::raw('SUM(Answer.Score) AS Score, users.username'))
            ->join('users', 'users.username', '=', 'Answer.username')
            ->join('Questions', 'Questions.questions_id', '=', 'Answer.questions_id')
            ->join('quizs', 'quizs.quizs_id', '=', 'Questions.quizs_id')
            ->where('quizs.quizs_id', '=', $quizs_id)
            ->groupBy('users.username')
            ->get();
         // For generate each user and each score
           
        $user_array[] = array('Username', 'Score');
        foreach ($user as $u) {
            $user_array[] = array(
                'Username' => $u->username,
                'Score' => $u->Score,
            );
        }


        // Max Score in each Quiz
        $max = DB::table('Answer')
        ->select(DB::raw('SUM(Answer.Score) AS maxScore,users.username'))
        ->join('users', 'users.username', '=', 'Answer.username')
        ->join('Questions', 'Questions.questions_id', '=', 'Answer.questions_id')
        ->join('quizs', 'quizs.quizs_id', '=', 'Questions.quizs_id')
        ->where('quizs.quizs_id', '=', $quizs_id)
        ->groupBy('users.username')
        ->get()->max();
        // Max Score in each Quiz


        // Min Score in each Quiz
        $min = DB::table('Answer')
        ->select(DB::raw('SUM(Answer.Score) AS minScore,users.username'))
        ->join('users', 'users.username', '=', 'Answer.username')
        ->join('Questions', 'Questions.questions_id', '=', 'Answer.questions_id')
        ->join('quizs', 'quizs.quizs_id', '=', 'Questions.quizs_id')
        ->where('quizs.quizs_id', '=', $quizs_id)
        ->groupBy('users.username')
        ->get()->min();
        // Min Score in each Quiz

        
        //Avg Score in each Quiz
        $sum = DB::table('Answer')
        ->select(DB::raw('SUM(Answer.Score) AS avgScore'))
        ->join('users', 'users.username', '=', 'Answer.username')
        ->join('Questions', 'Questions.questions_id', '=', 'Answer.questions_id')
        ->join('quizs', 'quizs.quizs_id', '=', 'Questions.quizs_id')
        ->where('quizs.quizs_id', '=', $quizs_id)
        ->get();

        $count = DB::table('users')
        ->select(DB::raw('users.username'))
        ->join('Answer', 'users.username', '=', 'Answer.username')
        ->join('Questions', 'Questions.questions_id', '=', 'Answer.questions_id')
        ->join('quizs', 'quizs.quizs_id', '=', 'Questions.quizs_id')
        ->where('quizs.quizs_id', '=', $quizs_id)
        ->groupBy('users.username')
        ->get()->count();
        //Avg Score in each Quiz
        
        $sum_score = $sum[0]->avgScore;
        $avg_score = $sum_score/$count;

        $max_score = $max->maxScore;
        $min_score = $min->minScore;
        // $avg_score = $avg->avgScore;
              

        Excel::create('User Score', function ($excel) use ($user_array,
        $quiz_name, $quiz_subject, $quiz_total,$max_score,$min_score, $avg_score) {
            $excel->setTitle('User Score');
            $excel->sheet('User Score', function ($sheet) use ($user_array,
        $quiz_name, $quiz_subject, $quiz_total,$max_score, $min_score, $avg_score) {
                $sheet->fromArray($user_array, null, 'A1', false, false);
                $sheet->setCellValue('E2', 'Quiz ');
                $sheet->setCellValue('E3', 'Subject');
                $sheet->setCellValue('E4', 'Total Score');
                $sheet->setCellValue('E5', 'Max');
                $sheet->setCellValue('E6', 'Min');
                $sheet->setCellValue('E7', 'Avg');

                $sheet->setCellValue('F2', $quiz_name);
                $sheet->setCellValue('F3', $quiz_subject);
                $sheet->setCellValue('F4', $quiz_total);
                $sheet->setCellValue('F5', $max_score);
                $sheet->setCellValue('F6', $min_score);
                $sheet->setCellValue('F7', $avg_score);

            });
        })->download('xlsx');

    }

}
