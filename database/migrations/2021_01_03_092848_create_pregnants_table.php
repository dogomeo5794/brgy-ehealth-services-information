<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePregnantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pregnants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pregnant_no', 30)->unique();
            $table->string('weight');
            $table->date('last_period');
            $table->date('expected_delivery');
            $table->boolean('is_labored')->default(false);
            $table->boolean('is_record_done')->default(false);
            $table->date('labor_date')->nullable();
            $table->longText('remarks')->nullable();
            $table->bigInteger('mother_id')->unsigned()->index();
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
        Schema::dropIfExists('pregnants');
    }
}
