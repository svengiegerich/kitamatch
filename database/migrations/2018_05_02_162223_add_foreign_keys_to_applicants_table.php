<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToApplicantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('applicants', function(Blueprint $table)
		{
			$table->foreign('gid', 'applicants_ibfk_1')->references('gid')->on('guardians')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('status', 'applicants_ibfk_2')->references('code')->on('codes')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('applicants', function(Blueprint $table)
		{
			$table->dropForeign('applicants_ibfk_1');
			$table->dropForeign('applicants_ibfk_2');
		});
	}

}
