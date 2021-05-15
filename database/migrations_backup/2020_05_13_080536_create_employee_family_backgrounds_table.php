<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeFamilyBackgroundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_family_backgrounds', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('family_relation', ['spouse', 'father', 'mother', 'child']);
            $table->string('lastname', 100);
            $table->string('firstname', 100);
            $table->string('middlename', 100);
            $table->json('metadata');

            $table->unsignedInteger('employee_id')->index();
            
            $table->timestamps();
            /**
             * 
             * if family_relation == father
             *      metadata: {
             *          'extension': 'jr/sr/none'
             *      }
             * 
             * if family_relation == mother
             *      metadata: {
             *          'maiden-name': ''
             *      }
             * 
             * /**
             * 
             * if family_relation == spouse
             *      metadata: {
             *          'occupation': '',
             *          'extension': '',
             *          'business_name': '',
             *          'business_address': '',
             *          'telno': ''
             *      }
             * 
             * if family_relation == child
             *      metadata: {
             *          'birthday': ''
             *      }
             *
             * 
             */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_family_backgrounds');
    }
}
