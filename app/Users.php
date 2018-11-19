<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';
    public $timestamps = false;
    protected $fillable = [
        'username','remark','firstname','lastname','password','change_password','passkey','status_banned'
    ];
}
