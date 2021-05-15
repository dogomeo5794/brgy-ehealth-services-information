<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeResidentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_residentials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('household')->nullable()->default(NULL);
            $table->string('street')->nullabel()->default(NULL);
            $table->string('subdivision')->nullable()->default(NULL);
            $table->string('barangay')->nullable()->default(NULL);
            $table->string('city');
            $table->string('province');
            $table->string('zipcode');
            $table->enum('address_type', ['residential', 'permanent'])->default('residential');

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
        Schema::dropIfExists('employee_residentials');
    }
}
