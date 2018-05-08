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
			$table->timestamps();
			$table->smallInteger('code')->unsigned()->primary();
			$table->string('value', 600);
		});

		//custome KitaMatch!
		DB::insert(
			"INSERT INTO `codes` (`updated_at`, `created_at`, `code`, `value`) VALUES
			(NULL, NULL, 10, 'not valid'),
			(NULL, NULL, 11, 'created, but not proofed; no participation'),
			(NULL, NULL, 12, 'valid; participates'),
			(NULL, NULL, 13, 'did not send offers for at least seven days; no participation'),
			(NULL, NULL, 20, 'not valid'),
			(NULL, NULL, 21, 'created, but not proofed; no participation'),
			(NULL, NULL, 22, 'valid'),
			(NULL, NULL, 25, 'priority'),
			(NULL, NULL, 26, 'finished matching'),
			(NULL, NULL, 30, 'no match'),
			(NULL, NULL, 31, 'current match'),
			(NULL, NULL, 32, 'final match'),
			(NULL, NULL, 33, 'historical match '),
			(NULL, NULL, 50, 'not valid (either no preferences or valid documents)'),
			(NULL, NULL, 51, 'created, but not proofed; no participation'),
			(NULL, NULL, 52, 'valid'),
			(NULL, NULL, 60, 'not valid (provider)'),
			(NULL, NULL, 61, 'valid (provider)'),
			(NULL, NULL, 820, 'Elternstatus: Eine/Ein Alleinerziehende/r beschäftig\r\n'),
			(NULL, NULL, 821, 'Elternstatus: Beide Erziehungsberechtigte beschäftigt'),
			(NULL, NULL, 822, 'Elternstatus: Ein Erziehungsberechtigter beschäftigt'),
			(NULL, NULL, 823, 'Elternstatus: Alleinerziehend ohne Beschäftigung'),
			(NULL, NULL, 824, 'Elternstatus: Sonstig'),
			(NULL, NULL, 830, 'Beschäftigungsumfang: Ganztags (ab 28 h/Woche)'),
			(NULL, NULL, 831, 'Beschäftigungsumfang: Halbtags (ab 16-27 h/Woche)'),
			(NULL, NULL, 832, 'Beschäftigungsumfang: Geringfügig (ab 8-15 h/Woche)'),
			(NULL, NULL, 833, 'Beschäftigungsumfang: Ohne Beschäftigung'),
			(NULL, NULL, 840, 'Kein Geschwisterkind'),
			(NULL, NULL, 841, 'Geschwisterkind');"
		);
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
