<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadQuestion extends Model
{
    protected $table = 'Question_pictures';
    public $timestamps = false;
    protected $primaryKey = 'question_pic_id';
}
