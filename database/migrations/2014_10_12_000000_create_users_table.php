<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('users', function (Blueprint $table) {
    		$table->bigIncrements('id');
    		$table->string('email', 30)->unique();
            $table->string('username', 30)->unique();
    		$table->string('default_password', 16)->nullable();
    		$table->timestamp('email_verified_at')->nullable();
    		$table->string('password');
    		$table->string('profile')->nullable();
    		$table->string('employee_id')->unique()->nullable();
    		$table->string('fullname')->nullable();
    		$table->date('birthdate')->nullable();
    		$table->string('address')->nullable();
    		$table->string('contact')->nullable();
    		$table->date('hired_date')->nullable();
    		$table->boolean('is_active')->default(true);
    		$table->enum('role',['admin', 'user'])->default('user');
    		$table->rememberToken();
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
    	Schema::dropIfExists('users');
    }
  }
