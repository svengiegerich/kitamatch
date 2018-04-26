<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApplicantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('applicants', function(Blueprint $table)
		{
			$table->integer('aid', true);
			$table->string('last_name', 20)->nullable();
			$table->string('first_name', 20)->nullable();
			$table->dateTime('birthday')->nullable();
			$table->string('gender', 20)->nullable();
			$table->boolean('status');
			$table->integer('gid')->nullable();
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
		Schema::drop('applicants');
	}

}
