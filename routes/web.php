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
    Route::get('/Admin/question/blankQuestion/{id?}','QuestionController@callBlankQuestion');
    Route::get('/Admin/question/shortAnswer/{id?}','QuestionController@callShortAnswerQuesstion');
    Route::get('/Admin/question/UploadQuestion/{id?}','QuestionController@callUploadFileQuesstion');
    Route::get('/Admin/question/MultipleChoice/{id?}','QuestionController@callMultipleChoice');

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

    //MultipleQuestion
    Route::get('/Admin/question/MultipleChoice','MultipleChoiceController@showUploadForms')->name('MultipleChoice.file');
    Route::post ('/Admin/question/MultipleChoice','MultipleChoiceController@storeFiles') ;
    Route::post('/Admin/question/MultipleChoicesubmit','MultipleChoiceController@submit');
    });

    //Student/subject
    Route::get('/Student/subject','SubjectController@index')->name('subject.indexStudent'); //name for reditect in update 
    //Student/quiz
    Route::get('/Student/quiz/{subject_id?}','QuizController@index')->name('quiz.StudentquizDetail'); //name use for redirect in update
    //Student/question 
    Route::get('/Student/question/{id?}','StudentQuestionController@index')->name('question.StudentQuestion'); //name for reditect in update
    //Student/answerBlankquestion 
    Route::get('/Student/question/AnswerBlankQuestion/{id?}','AnswerBlankController@index')->name('AnswerBlankQuestion.file'); //name for reditect in update
    Route::post('/Student/question/AnswerBlankQuestion/{id?}','AnswerBlankController@store'); //name 
    Route::post('/Student/AnswerBlankQuestion/submit/{id?}','AnswerBlankController@submit');
    //Student/answerShortquestion 
    Route::get('/Student/question/AnswerShortQuestion/{id?}','AnswerShortQuestionController@index')->name('AnswerShortQuestion.file'); //name for reditect in update
    Route::post('/Student/question/AnswerShortQuestion/{id?}','AnswerShortQuestionController@store'); //name 
    Route::post('/Student/AnswerShortQuestion/submit/{id?}','AnswerShortQuestionControllerr@submit');


    