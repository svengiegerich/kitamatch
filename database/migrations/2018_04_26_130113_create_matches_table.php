<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatchesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matches', function(Blueprint $table)
		{
			$table->integer('mid', true);
			$table->integer('aid');
			$table->integer('pid');
			$table->timestamps();
			$table->boolean('status');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('matches');
	}

}
