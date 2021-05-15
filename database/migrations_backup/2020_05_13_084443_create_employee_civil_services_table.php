<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeCivilServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_civil_services', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('rating', 3, 2)->default(00.00);
            $table->date('exam_date');
            $table->string('exam_place');
            $table->string('license_no')->nullable()->default(NULL);
            $table->date('date_release')->nullable()->default(NULL);
            
            $table->unsignedInteger('career_service_id')->index();

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
        Schema::dropIfExists('employee_civil_services');
    }
}
