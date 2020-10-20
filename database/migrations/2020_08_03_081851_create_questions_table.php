<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('question_image_url', 150);
            $table->integer('correct_answer');
            $table->string('solution_image_url', 150);
//            $table->string('subject', 50);
//            $table->unsignedInteger('test_year');
//            $table->unsignedTinyInteger('test_month');
            $table->string('source_of_question', 150);
            $table->unsignedTinyInteger('question_number')->nullable();
            $table->unsignedTinyInteger('part1');
            $table->unsignedTinyInteger('part2');
            $table->unsignedTinyInteger('part3');
            $table->tinyInteger('score')->nullable();
            $table->unsignedTinyInteger('type');
            // 0이면 주관식, 1이면 객관식
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
