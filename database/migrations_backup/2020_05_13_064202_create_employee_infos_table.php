<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('height', 10)->comment('cm, m, inch, ft');
            $table->string('weight', 10)->comment('lbs, kl');
            $table->enum('bloodtype', ['0+', '0-', 'a+', 'a-', 'b+', 'b-', 'ab+', 'ab-']);
            $table->json('telno')->comment('multiple telno');
            $table->json('cellphone')->comment('multiple cellphone number');
            $table->string('email')->unique();

            $table->enum('active_status', ['active', 'inactive'])->default('active');
            $table->json('active_status_date')->comment('multiple data { type: "inactive", date: "2020-05-07" }');
            $table->enum('approve_status', ['approved', 'denied', 'void', 'cancelled'])->default('approved');
            $table->json('approve_status_date')->comment('multiple data { type: "denied", date: "2020-05-07" }');

            $table->unsignedInteger('department_id')->index();
            $table->unsignedInteger('category_id')->index();
            $table->unsignedInteger('academic_rank_id')->index();

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
        Schema::dropIfExists('employee_infos');
    }
}
