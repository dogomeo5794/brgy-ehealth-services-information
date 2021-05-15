<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeEducationalBackgroundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_educational_backgrounds', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('school_level', ['elementary', 'secondary', 'vocational', 'college', 'graduate']);
            $table->string('course_degree');
            $table->date('graduated_date')->nullable()->default(NULL);
            $table->string('highest_level')->nullable()->default(NULL);
            $table->date('schooling_date_from')->nullable()->default(NULL);
            $table->date('schooling_date_to')->nullable()->default(NULL);
            $table->string('scholarship_or_honor')->nullable()->default(NULL);

            $table->unsignedInteger('school_id')->index();

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
        Schema::dropIfExists('employee_educational_backgrounds');
    }
}
