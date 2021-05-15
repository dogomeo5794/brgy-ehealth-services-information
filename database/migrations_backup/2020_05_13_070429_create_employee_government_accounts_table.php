<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeGovernmentAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_government_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('account_type', ['gsis', 'pagibig', 'philhealth', 'sss', 'tin', 'employee_agency']);
            $table->string('account_number');

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
        Schema::dropIfExists('employee_government_accounts');
    }
}
