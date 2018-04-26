<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProviderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('provider', function(Blueprint $table)
		{
			$table->integer('proid', true);
			$table->timestamps();
			$table->string('name', 250)->nullable();
			$table->string('phone', 200)->nullable();
			$table->integer('uid')->nullable();
			$table->string('address', 400)->nullable();
			$table->integer('plz')->nullable();
			$table->string('city', 250)->nullable();
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
		Schema::drop('provider');
	}

}
