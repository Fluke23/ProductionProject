<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'Questions';
    public $timestamps = false;
    public $primaryKey = 'questions_id';
    protected $fillable = ['questions_id','number','question','quizs_id','score','solution','questions_types_id','question_pic_id'];

    
}
