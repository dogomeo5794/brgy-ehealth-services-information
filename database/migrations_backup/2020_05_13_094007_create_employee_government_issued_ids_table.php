<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeGovernmentIssuedIdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_government_issued_ids', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vernment_issued_id');
            $table->string('account_number');

            $table->date('date_issued')->nullable()->default(NULL);
            $table->string('place_issued')->nullable()->default(NULL);

            $table->unsignedInteger('employee_file_id')->index()->nullable(); // Attachment files

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
        Schema::dropIfExists('employee_government_issued_ids');
    }
}
