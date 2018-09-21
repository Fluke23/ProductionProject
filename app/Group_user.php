<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group_user extends Model
{
    protected $table = 'Group_user';
    protected $fillable = ['groups_id','username','user_id'];
}
