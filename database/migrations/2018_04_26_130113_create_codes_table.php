<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('codes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->timestamps();
			$table->integer('code')->unique('code');
			$table->string('value', 600);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('codes');
	}

}
