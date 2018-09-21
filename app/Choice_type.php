<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choice_type extends Model
{
    protected $table = 'Choice';
    public $timestamps = false;
    public $primaryKey = 'choice_type_id';
    protected $fillable = ['choice_type_id','choice'];
}
