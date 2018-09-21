<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quizs';
    public $timestamps = false;
    public $primaryKey = 'quizs_id';
    protected $fillable = ['title','description','subject_id','groups_id','quizs_types_id','quizs_status_id','quiz_date'];

    // public function quiz_status(){
    //     return $this->belongsTo('App\Quiz_status');
    // }

    // public function quiz_type(){
    //     return $this->belongsTo('App\quiz_type');
    // }
}
