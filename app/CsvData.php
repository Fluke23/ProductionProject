<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CsvData extends Model
{

    public $table = "CsvData";
    protected $fillable = ['csv_filename','csv_header','csv_data'];
    public $timestamps = false;
}