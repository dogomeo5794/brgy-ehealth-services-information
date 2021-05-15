<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeVolunteersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_volunteers', function (Blueprint $table) {
            $table->increments('id');
            $table->date('volunteer_date_from');
            $table->date('volunteer_date_to');
            $table->integer('volunteer_hours');
            $table->string('volunteer_position');

            $table->unsignedInteger('agency_or_company_id')->index(); // company or organizations

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
        Schema::dropIfExists('employee_voluntary');
    }
}
