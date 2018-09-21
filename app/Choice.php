<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    protected $table = 'Choice';
    public $timestamps = false;
    public $primaryKey = 'choice_id';
    protected $fillable = ['choice','choice_type_id'];
}
