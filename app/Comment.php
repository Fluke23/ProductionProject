<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'Comment';
    public $timestamps = true;
    public $primaryKey = 'comment_id';
   
}
