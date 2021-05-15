<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeWorkExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_work_experiences', function (Blueprint $table) {
            $table->increments('id');
            $table->date('work_date_from');
            $table->date('work_date_to');
            $table->string('position');
            $table->decimal('salary', 6, 2);
            $table->string('salary_grade');
            $table->string('appointment_status');
            $table->enum('is_government_service', ['yes', 'no'])->default('no');

            $table->unsignedInteger('agency_or_company_id')->index();

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
        Schema::dropIfExists('employee_work_experiences');
    }
}
