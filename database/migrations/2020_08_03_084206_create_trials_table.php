<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_id');
            $table->foreign('question_id')->references('id')->on('questions');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean('option1');
            $table->boolean('option2');
            $table->boolean('option3');
            $table->boolean('option4');
            $table->boolean('option5');
            $table->time('time_taken');
            $table->integer('choice')->nullable();
            $table->boolean('is_correct')->nullable();
            $table->unsignedBigInteger('nth_trial');
            $table->unsignedTinyInteger('test_mode');
            $table->boolean('remember');
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
        Schema::dropIfExists('trials');
    }
}
