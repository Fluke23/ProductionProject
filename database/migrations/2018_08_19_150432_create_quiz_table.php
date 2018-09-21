<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz', function (Blueprint $table) {
            $table->integer('quiz_id');
            $table->dateTime('quiz_date');
            $table->string('quiz_title');
            $table->string('quiz_description');
            $table->timestamps();

            //foreign key
            $table->foreign('quiz_status_id')->references('id')->on('quiz_status');
            $table->foreign('quiz_type_id')->references('id')->on('quiz_type');
            $table->foreign('subject_id')->references('id')->on('subject');
            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz');
    }
}
