<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('birth_order');
            $table->string('firstname', 100);
            $table->string('middlename', 100);
            $table->string('lastname', 100);
            $table->date('birthdate');
            $table->string('born_weight')->nullable();
            $table->string('born_at')->comment('place where to born');
            $table->string('born_place', 100);
            $table->enum('gender', ['male', 'female']);
            $table->longText('remarks')->nullable();
            $table->bigInteger('parent_id')->unsigned()->index();
            $table->boolean('is_record_done')->default(false);
            $table->datetime('record_done_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('children');
    }
}
