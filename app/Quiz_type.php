<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz_type extends Model
{
    protected $table = 'Quiz_types';
    public $primaryKey = 'quizs_types_id';
    protected $fillable = ['quizs_types_id'];
    
}
