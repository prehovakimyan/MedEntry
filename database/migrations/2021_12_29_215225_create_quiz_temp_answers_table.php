<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizTempAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_temp_answers', function (Blueprint $table) {
            $table->id();
            $table->string('token');
            $table->integer('score');
            $table->integer('question_id');
            $table->tinyInteger('answer');
            $table->tinyInteger('question_answer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_temp_answers');
    }
}
