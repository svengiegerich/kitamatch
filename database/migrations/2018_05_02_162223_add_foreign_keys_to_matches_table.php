<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMatchesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('matches', function(Blueprint $table)
		{
			$table->foreign('aid', 'matches_ibfk_1')->references('aid')->on('applicants')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('pid', 'matches_ibfk_2')->references('pid')->on('programs')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('status', 'matches_ibfk_3')->references('code')->on('codes')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('matches', function(Blueprint $table)
		{
			$table->dropForeign('matches_ibfk_1');
			$table->dropForeign('matches_ibfk_2');
			$table->dropForeign('matches_ibfk_3');
		});
	}

}
