<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class shortAnswerQuestion extends Model
{
    protected $table = 'Question_pictures';
    public $timestamps = false;
    protected $primaryKey = 'question_pic_id';
}
