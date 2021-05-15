<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    private $tables = array(
    	array(
    		'table' => 'pregnants',
    		'fk' => array(
    			[
    				'foreign' => 'mother_id',
    				'ref' => 'id',
    				'on' => 'mothers'
    			]
    		)
    	),
    	array(
    		'table' => 'prenatals',
    		'fk' => array(
    			[
    				'foreign' => 'pregnant_id',
    				'ref' => 'id',
    				'on' => 'pregnants'
    			]
    		)
    	),
    	array(
    		'table' => 'children',
    		'fk' => array(
    			[
    				'foreign' => 'parent_id',
    				'ref' => 'id',
    				'on' => 'parents'
    			]
    		)
    	),
    	array(
    		'table' => 'parents',
    		'fk' => array(
    			[
    				'foreign' => 'mother_id',
    				'ref' => 'id',
    				'on' => 'mothers'
    			],
    			[
    				'foreign' => 'father_id',
    				'ref' => 'id',
    				'on' => 'fathers'
    			]
    		)
    	),
    	array(
    		'table' => 'reset_passwords',
    		'fk' => array(
    			[
    				'foreign' => 'user_id',
    				'ref' => 'id',
    				'on' => 'users'
    			]
    		)
    	),
    );

    public function up()
    {
    	foreach ($this->tables as $tbl) {
    		Schema::table("{$tbl['table']}", function (Blueprint $table) use ($tbl) {
    			foreach ($tbl['fk'] as $fk) {
    				$table->foreign("{$fk['foreign']}")
    				->references("{$fk['ref']}")
    				->on("{$fk['on']}")
    				->onUpdate('cascade')
    				->onDelete('cascade');
    			}
    		});
    	}
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	foreach($this->tables as $key => $tbl) {
    		Schema::table("{$tbl['table']}", function (Blueprint $table) use ($tbl) {
    			foreach($tbl['fk'] as $fk) {
    				$table->dropForeign(["{$fk['foreign']}"]);
    			}
    		});
    	}
    }
  }
