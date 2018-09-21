<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadQuestion1 extends Model
{
    protected $table = 'Questions';
   public $timestamps = false;
    protected $primaryKey = 'questions_id';
}
