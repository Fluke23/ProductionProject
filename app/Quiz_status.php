<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz_status extends Model
{
    protected $table = 'Quiz_status';
    public $primaryKey = 'quizs_status_id';
    protected $fillable = ['quizs_status_id'];
    
}
