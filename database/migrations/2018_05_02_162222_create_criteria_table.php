<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCriteriaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('criteria', function(Blueprint $table)
		{
			$table->increments('cid');
			$table->timestamps();
			$table->string('criterium_name', 250);
			$table->smallInteger('criterium_value')->unsigned()->index('criterium_value');
			$table->boolean('multiplier')->nullable();
			$table->integer('p_id')->nullable();
			$table->boolean('rank');
			$table->boolean('program')->nullable();
		});

		//custome KitaMatch!
		DB::insert(
			"INSERT INTO `criteria` (`cid`, `created_at`, `updated_at`, `criterium_name`, `criterium_value`, `multiplier`, `p_id`, `rank`, `program`) VALUES
			(1, NULL, NULL, 'parental_status', 820, 1, -1, 1, NULL),
			(2, NULL, NULL, 'parental_status', 821, 1, -1, 2, NULL),
			(3, NULL, NULL, 'parental_status', 822, 1, -1, 3, NULL),
			(4, NULL, NULL, 'volume_of_employment', 830, 1, -1, 4, NULL),
			(5, NULL, NULL, 'volume_of_employment', 831, 1, -1, 5, NULL),
			(6, NULL, NULL, 'volume_of_employment', 832, 1, -1, 6, NULL),
			(7, NULL, NULL, 'siblings', 841, 1, -1, 7, NULL),(101, NULL, NULL, 'volume_of_employment', 833, 1, -1, 8, NULL),
			(102, NULL, NULL, 'siblings', 840, 1, -1, 9, NULL),
			(103, NULL, NULL, 'parental_status', 824, 1, -1, 10, NULL)"
		);
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('criteria');
	}

}
