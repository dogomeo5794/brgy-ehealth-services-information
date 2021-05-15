<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cs_id')->unique();
            $table->string('lastname', 100);
            $table->string('firstname', 100);
            $table->string('middlename', 100);
            $table->string('extension_name', 10);
            $table->date('birthday');
            $table->enum('gender', ['male', 'female']);
            $table->string('civil_status', 50);
            $table->json('citizenship')->comment('e.i data: { citizenship: "dual citizenship", by: "by birth", country: "american" }');
            
            $table->unsignedInteger('employee_file_id')->index()->nullable(); // profile pictures
            
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
        Schema::dropIfExists('employees');
    }
}
