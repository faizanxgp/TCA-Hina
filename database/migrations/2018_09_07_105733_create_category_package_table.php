<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoryPackageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('category_package', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('package_id');
			$table->integer('category_id');
			$table->timestamps();
			$table->unique(['package_id','category_id'], 'package_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('category_package');
	}

}
