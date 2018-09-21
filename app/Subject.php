<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model 
{
    protected $table = 'Subjects';
    public $primaryKey = 'subject_id';
    public $timestamps = false;
    // protected $fillable = ['subject_id','subject_name'];
}
