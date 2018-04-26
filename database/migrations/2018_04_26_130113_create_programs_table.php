<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProgramsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('programs', function(Blueprint $table)
		{
			$table->integer('pid', true);
			$table->string('name', 250)->nullable();
			$table->string('address', 25)->nullable();
			$table->integer('capacity')->nullable();
			$table->boolean('p_kind')->nullable();
			$table->boolean('status')->nullable();
			$table->boolean('coordination')->nullable();
			$table->integer('uid')->nullable();
			$table->integer('proid')->nullable();
			$table->string('phone', 20)->nullable();
			$table->integer('plz')->nullable();
			$table->string('city', 20)->nullable();
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
		Schema::drop('programs');
	}

}
