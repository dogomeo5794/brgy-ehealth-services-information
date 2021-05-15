<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrenatalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prenatals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('return_date')->nullable();
            $table->date('date_conduct')->nullable();
            $table->longText('data');
            $table->enum('checkup_order', ['1', '2', '3']);
            $table->enum('trimester', ['1st', '2nd', '3rd']);
            $table->enum('record_status', ['done', 'no-data', 'with-data'])->default('done');
            $table->bigInteger('pregnant_id')->unsigned()->index();
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
        Schema::dropIfExists('prenatals');
    }
}
