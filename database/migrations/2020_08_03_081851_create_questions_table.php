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
            $table->string('question_image_name', 100);
            $table->integer('correct_answer');
            $table->string('solution_image_name', 100);
            $table->string('subject', 50);
//            $table->unsignedInteger('test_year');
//            $table->unsignedTinyInteger('test_month');
            $table->string('source_of_question', 150);
            $table->unsignedTinyInteger('question_number')->nullable();
            // 단원과 관련된 내용
            $table->tinyInteger('score')->nullable();
            $table->unsignedTinyInteger('type');
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
