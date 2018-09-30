<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('/auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['Admin']], function () {
	Route::get('/Admin/quiz/{subject_id?}','QuizController@index')->name('quiz.quizDetail'); //name use for redirect in update
});
    //Admin/quiz
    Route::get('/Admin/quiz/quizDetail/{subject_id?}','QuizController@index')->name('quiz.quizDetail'); //name use for redirect in update
    Route::get('/Admin/quiz/addQuiz/{subject_id?}','QuizController@create')->name('addQuiz');
    Route::post('/Admin/quiz/saveQuiz/{subject_id?}','QuizController@store');
    Route::get('/Admin/quiz/editQuiz/{subject_id?}','QuizController@edit');
    Route::post('/Admin/quiz/updateQuiz','QuizController@update');
    Route::get('/Admin/quiz/deleteQuiz/{id?}/{subject_id?}','QuizController@destroy');



    //Admin/subject
    Route::get('/Admin/subject','SubjectController@index')->name('subject.index'); //name for reditect in update 
    Route::get('/Admin/subject/addSubject','SubjectController@create')->name('addSubject');;
    Route::post('/Admin/subject/saveSubject','SubjectController@store');
    Route::get('/Admin/subject/editSubject/{id?}','SubjectController@edit');
    Route::post('/Admin/subject/updateSubject','SubjectController@update');
    Route::get('/Admin/subject/deleteSubject/{id?}','SubjectController@destroy');


    //question 
    Route::get('/Admin/question/{id?}','QuestionController@index')->name('question.index'); //name for reditect in update
    //Route::get('/question/addQuestion/{id?}','QuestionController@create')->name('question.addQuestion');
    Route::post('/Admin/question/saveQuestion/{id?}','QuestionController@store');
    Route::get('/Admin/question/editQuestion/{subject_id?}','QuestionController@edit');
    Route::post('/Admin/question/updateQuestion','QuestionController@update');
    Route::get('/Admin/question/deleteQuestion/{id?}/{quiz_id?}','QuestionController@destroy');
    Route::get('/Admin/question/blankQuestion/{id?}','QuestionController@callBlankQuestion');
    Route::get('/Admin/question/shortAnswer/{id?}','QuestionController@callShortAnswerQuesstion');
    Route::get('/Admin/question/UploadQuestion/{id?}','QuestionController@callUploadFileQuesstion');
    Route::get('/Admin/question/MultipleChoice/{id?}','QuestionController@callMultipleChoice')->name('Question.callMultipleChoice');
    Route::get('/Admin/question/TrueFalse/{id?}','QuestionController@callTrueFalse');

    //testChoice
    Route::get('/Admin/choiceType/addMultiple/{id?}','QuestionController@callMultiple');
    Route::get('/choiceType/addTF/{id?}','QuestionController@callTF');
    Route::get('/choiceType/addBlank/{id?}','QuestionController@callBlank');

    //user manager for admin
    Route::get('/Admin/userManager','UserController@index')->name('userManager.index'); //name for reditect in update
    Route::get('/Admin/userManager/viewUserInfo/{username?}','UserController@viewStudent');
    Route::get('/Admin/userManager/addGroupUser','UserController@create');
    Route::post('/Admin/userManager/saveUser','UserController@store')->name('saveUser');
    Route::get('/Admin/userManager/delete/{id?}','UserController@destroy');

    //Admin/blankQuestion
    Route::get('/Admin/question/blankQuestion','blankQuestionController@showUploadForms')->name('blankQuestion.file');
    Route::post ('/Admin/question/blankQuestion','blankQuestionController@storeFiles') ;
    Route::post('/Admin/question/blankQuestion/submit','blankQuestionController@submit');

    //Admin/shortanswer
    Route::get('/Admin/shortAnswer','shortAnswerQuestionController@showUploadForms')->name('shortAnswer.file');
    Route::post ('/Admin/shortAnswer','shortAnswerQuestionController@storeFiles') ;
    Route::post('/Admin/shortAnswer/submit','shortAnswerQuestionController@submit');

    //Admin/uploadQuestion
    Route::get('/Admin/UploadQuestion','UploadQuestionController@showUploadForms')->name('UploadQuestion.file');
    Route::post ('/Admin/UploadQuestion','UploadQuestionController@storeFiles') ;
    Route::post('/Admin/UploadQuestion/submit','UploadQuestionController@submit');

    //admin/MultipleQuestion
    Route::get('/Admin/question/MultipleChoice','MultipleChoiceController@showUploadForms')->name('MultipleChoice.file');
    Route::post ('/Admin/question/MultipleChoice','MultipleChoiceController@storeFiles') ;
    Route::post('/Admin/question/MultipleChoicesubmit','MultipleChoiceController@submit');

    //TrueFalseQuestion
    Route::get('/Admin/question/TrueFalse','TrueFalseController@showUploadForms')->name('TrueFalse.file');
    Route::post ('/Admin/question/TrueFalse','TrueFalseController@storeFiles') ;
    Route::post('/Admin/question/TrueFalsesubmit','TrueFalseController@submit');
   



    //Lecturer/subject
    Route::get('/Lecturer/subject','SubjectController@index')->name('lec.subject.index'); //name for reditect in update 
    Route::get('/Lecturer/subject/addSubject','SubjectController@create')->name('lec.addSubject');;
    Route::post('/Lecturer/subject/saveSubject','SubjectController@store');
    Route::get('/Lecturer/subject/editSubject/{id?}','SubjectController@edit');
    Route::post('/Lecturer/subject/updateSubject','SubjectController@update');
    Route::get('/Lecturer/subject/deleteSubject/{id?}','SubjectController@destroy');

    //lecturer/quiz
    Route::get('/Lecturer/quiz/index/{subject_id?}','QuizController@index')->name('lec.quiz.quizDetail'); //name use for redirect in update
    Route::get('/Lecturer/quiz/addQuiz/{subject_id?}','QuizController@create')->name('lec.addQuiz');
    Route::post('/Lecturer/quiz/saveQuiz/{subject_id?}','QuizController@store');
    Route::get('/Lecturer/quiz/editQuiz/{subject_id?}','QuizController@edit');
    Route::post('/Lecturer/quiz/updateQuiz','QuizController@update');
    Route::get('/Lecturer/quiz/deleteQuiz/{id?}/{subject_id?}','QuizController@destroy');

     //question 
     Route::get('/lecturer/question/{id?}','QuestionController@index')->name('lec.question.index'); //name for reditect in update
     //Route::get('/question/addQuestion/{id?}','QuestionController@create')->name('question.addQuestion');
     Route::post('/lecturer/question/saveQuestion/{id?}','QuestionController@store');
     Route::get('/Lecturer/question/editQuestion/{subject_id?}','QuestionController@edit');
     Route::post('/Lecturer/question/updateQuestion','QuestionController@update');
     Route::get('/Lecturer/question/deleteQuestion/{id?}/{quiz_id?}','QuestionController@destroy');
     Route::get('/Lecturer/question/blankQuestion/{id?}','QuestionController@callBlankQuestion');
     Route::get('/Lecturer/question/shortAnswer/{id?}','QuestionController@callShortAnswerQuesstion');
     Route::get('/Lecturer/question/UploadQuestion/{id?}','QuestionController@callUploadFileQuesstion');
     Route::get('/Lecturer/question/MultipleChoice/{id?}','QuestionController@callMultipleChoice')->name('lec.Question.callMultipleChoice');
     Route::get('/Lecturer/question/TrueFalse/{id?}','QuestionController@callTrueFalse');
 
     //testChoice
     Route::get('/Lecturer/choiceType/addMultiple/{id?}','QuestionController@callMultiple');
     Route::get('/choiceType/addTF/{id?}','QuestionController@callTF');
     Route::get('/choiceType/addBlank/{id?}','QuestionController@callBlank');
 
     //user manager for admin
     Route::get('/Lecturer/userManager','UserController@index')->name('lec.userManager.index'); //name for reditect in update
     Route::get('/Lecturer/userManager/viewUserInfo/{username?}','UserController@viewStudent');
     Route::get('/Lecturer/userManager/addGroupUser','UserController@create');
     Route::post('/Lecturer/userManager/saveUser','UserController@store')->name('lec.saveUser');
     Route::get('/Lecturer/userManager/delete/{id?}','UserController@destroy');
 
     //Lecturer/blankQuestion
     Route::get('/Lecturer/question/blankQuestion','blankQuestionController@showUploadForms')->name('lec.blankQuestion.file');
     Route::post ('/Lecturer/question/blankQuestion','blankQuestionController@storeFiles') ;
     Route::post('/Lecturer/question/blankQuestion/submit','blankQuestionController@submit');
 
     //Admin/shortanswer
     Route::get('/Lecturer/shortAnswer','shortAnswerQuestionController@showUploadForms')->name('lec.shortAnswer.file');
     Route::post ('/Lecturer/shortAnswer','shortAnswerQuestionController@storeFiles') ;
     Route::post('/Lecturer/shortAnswer/submit','shortAnswerQuestionController@submit');
 
     //Admin/uploadQuestion
     Route::get('/Lecturer/UploadQuestion','UploadQuestionController@showUploadForms')->name('lec.UploadQuestion.file');
     Route::post ('/Lecturer/UploadQuestion','UploadQuestionController@storeFiles') ;
     Route::post('/Lecturer/UploadQuestion/submit','UploadQuestionController@submit');
 
     //admin/MultipleQuestion
     Route::get('/Lecturer/question/MultipleChoice','MultipleChoiceController@showUploadForms')->name('lec.MultipleChoice.file');
     Route::post ('/Lecturer/question/MultipleChoice','MultipleChoiceController@storeFiles') ;
     Route::post('/Lecturer/question/MultipleChoicesubmit','MultipleChoiceController@submit');
 
     //TrueFalseQuestion
     Route::get('/Lecturer/question/TrueFalse','TrueFalseController@showUploadForms')->name('lec.TrueFalse.file');
     Route::post ('/Lecturer/question/TrueFalse','TrueFalseController@storeFiles') ;
     Route::post('/Lecturer/question/TrueFalsesubmit','TrueFalseController@submit');

    



    //Student/subject
    Route::get('/Student/subject','SubjectController@index')->name('subject.Studentindex'); //name for reditect in update 
   

    //Student/quiz
    Route::get('/Student/quiz/StudentquizDetail/{subject_id?}','QuizController@index')->name('quiz.StudentquizDetail'); //name use for redirect in update
    
    //Student/question 
    Route::get('/Student/question/StudentQuestion/{quiz_id?}','StudentQuestionController@index')->name('question.StudentQuestion'); //name for reditect in update
    //Student/answerBlankquestion 
    Route::get('/Student/question/AnswerBlankQuestion/{id?}/{quiz_id?}','AnswerBlankController@index')->name('AnswerBlankQuestion.file'); //name for reditect in update
    Route::post('/Student/question/AnswerBlankQuestion/{id?}/{quiz_id?}','AnswerBlankController@store'); //name 
    Route::post('/Student/AnswerBlankQuestionsubmit/{id?}/{quiz_id?}','AnswerBlankController@submit');
    //Student/answerShortquestion 
    Route::get('/Student/question/AnswerShortQuestion/{id?}/{quiz_id?}','AnswerShortQuestionController@index')->name('AnswerShortQuestion.file'); //name for reditect in update
    Route::post('/Student/question/AnswerShortQuestion/{id?}/{quiz_id?}','AnswerShortQuestionController@store'); //name 
    Route::post('/Student/AnswerShortQuestion/submit/{id?}/{quiz_id?}','AnswerShortQuestionController@submit');
                                                                       

    //Student/answerUploadquestion 
    Route::get('/Student/question/AnswerUploadQuestion/{id?}/{quiz_id?}','answerUploadQuestionController@index')->name('AnswerUploadQuestion.file'); //name for reditect in update
    Route::post('/Student/question/AnswerUploadQuestion/{id?}/{quiz_id?}','answerUploadQuestionController@store'); //name 
    Route::post('/Student/AnswerUploadQuestion/submit/{id?}/{quiz_id?}','answerUploadController@submit');

    //Student/answerMultiplequestion 
    Route::get('/Student/question/AnswerMultipleQuestion/{id?}/{quiz_id?}','answerMultipleQuestionController@index')->name('AnswerMultipleQuestion.file'); //name for reditect in update
    Route::post('/Student/question/AnswerMultipleQuestion/{id?}/{quiz_id?}','answerMultipleQuestionController@store'); //name 
    Route::post('/Student/AnswerMultipleQuestion/submit/{id?}/{quiz_id?}','answerMultipleController@submit');
    
    //Student/answerTrueFalsequestion 
    Route::get('/Student/question/AnswerTrueFalseQuestion/{id?}/{quiz_id?}}','answerTrueFalseQuestionController@index')->name('AnswerTrueFalseQuestion.file'); //name for reditect in update
    Route::post('/Student/question/AnswerTrueFalseQuestion/{id?}/{quiz_id?}','answerTrueFalseQuestionController@store'); //name 
    Route::post('/Student/AnswerTrueFalseQuestion/submit/{id?}/{quiz_id?}','answerTrueFalseController@submit');
