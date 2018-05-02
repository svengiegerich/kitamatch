<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCriteriaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('criteria', function(Blueprint $table)
		{
			$table->foreign('criterium_value', 'criteria_ibfk_1')->references('code')->on('codes')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('criteria', function(Blueprint $table)
		{
			$table->dropForeign('criteria_ibfk_1');
		});
	}

}
