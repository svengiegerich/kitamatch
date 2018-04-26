<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCriteriaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('criteria', function(Blueprint $table)
		{
			$table->integer('cid', true);
			$table->timestamps();
			$table->string('criterium_name', 250)->nullable();
			$table->string('criterium_value', 400)->nullable();
			$table->integer('multiplier')->nullable();
			$table->integer('p_id')->nullable();
			$table->integer('rank')->nullable();
			$table->boolean('program')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('criteria');
	}

}
