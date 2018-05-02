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
			$table->increments('cid');
			$table->timestamps();
			$table->string('criterium_name', 250);
			$table->smallInteger('criterium_value')->unsigned()->index('criterium_value');
			$table->boolean('multiplier')->nullable();
			$table->integer('p_id')->nullable();
			$table->boolean('rank');
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
