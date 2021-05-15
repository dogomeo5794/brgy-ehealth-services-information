<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeQuestionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_question_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('question_answer', ['yes', 'no']);
            $table->json('metadata'); // if there's another extra answers

            $table->unsignedInteger('question_content_id')->index();

            $table->unsignedInteger('employee_id')->index();

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
        Schema::dropIfExists('employee_question_answers');
    }
}
