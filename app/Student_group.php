<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student_group extends Model
{
    protected $table = 'Student_group';
    public $primaryKey = 'student_group_id';
    public $timestamps = false;
}
