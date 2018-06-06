<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProgramsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('programs', function(Blueprint $table)
		{
			$table->foreign('proid', 'programs_ibfk_1')->references('proid')->on('providers')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('uid', 'programs_ibfk_2')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('status', 'programs_ibfk_3')->references('code')->on('codes')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('programs', function(Blueprint $table)
		{
			$table->dropForeign('programs_ibfk_1');
			$table->dropForeign('programs_ibfk_2');
			$table->dropForeign('programs_ibfk_3');
		});
	}

}
