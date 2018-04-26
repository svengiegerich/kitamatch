<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGuardiansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('guardians', function(Blueprint $table)
		{
			$table->integer('gid', true);
			$table->string('last_name', 40)->nullable();
			$table->string('first_name', 40)->nullable();
			$table->integer('uid');
			$table->timestamps();
			$table->string('address', 40)->nullable();
			$table->string('city', 40)->nullable();
			$table->integer('plz')->nullable();
			$table->smallInteger('siblings')->nullable();
			$table->smallInteger('parental_status')->nullable();
			$table->string('phone', 20)->nullable();
			$table->smallInteger('volume_of_employment')->nullable();
			$table->integer('status')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('guardians');
	}

}
