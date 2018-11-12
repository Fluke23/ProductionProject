<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'Groups';
    public $primaryKey = 'groups_id';
    protected $fillable = ['groups_id'];
    public $timestamps = false;

}
