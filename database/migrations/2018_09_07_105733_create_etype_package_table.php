<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEtypePackageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('etype_package', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('package_id');
			$table->integer('etype_id');
			$table->timestamps();
			$table->unique(['package_id','etype_id'], 'package_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('etype_package');
	}

}
