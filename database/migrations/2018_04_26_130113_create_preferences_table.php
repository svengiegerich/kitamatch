<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePreferencesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('preferences', function(Blueprint $table)
		{
			$table->integer('prid', true);
			$table->integer('id_from');
			$table->integer('id_to');
			$table->integer('pr_kind');
			$table->timestamps();
			$table->integer('rank');
			$table->boolean('status')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('preferences');
	}

}
