<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImmunizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('immunizations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('return_date')->nullable();
            $table->date('date_conduct')->nullable();
            $table->longText('data');
            $table->enum('record_at', ['1st', '2nd', '3rd', '4th', '5th', '6th']);
            $table->enum('record_status', ['no-data', 'with-data'])->default('with-data');
            $table->bigInteger('children_id')->unsigned()->index();
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
        Schema::dropIfExists('immunizations');
    }
}
