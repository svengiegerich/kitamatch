<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGuardiansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('guardians', function(Blueprint $table)
		{
			$table->foreign('uid', 'guardians_ibfk_1')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('siblings', 'guardians_ibfk_3')->references('code')->on('codes')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('parental_status', 'guardians_ibfk_4')->references('code')->on('codes')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('volume_of_employment', 'guardians_ibfk_5')->references('code')->on('codes')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('status', 'guardians_ibfk_6')->references('code')->on('codes')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('guardians', function(Blueprint $table)
		{
			$table->dropForeign('guardians_ibfk_1');
			$table->dropForeign('guardians_ibfk_3');
			$table->dropForeign('guardians_ibfk_4');
			$table->dropForeign('guardians_ibfk_5');
			$table->dropForeign('guardians_ibfk_6');
		});
	}

}
