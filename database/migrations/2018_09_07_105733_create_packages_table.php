<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePackagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('packages', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('package');
			$table->integer('duration')->default(0);
			$table->integer('pins');
			$table->integer('downloads');
			$table->boolean('event_visibility')->default(0);
			$table->boolean('partner')->default(0);
			$table->boolean('activity')->default(0);
			$table->boolean('community')->default(0);
			$table->boolean('new_event')->default(0);
			$table->boolean('invite_team')->default(0);
			$table->boolean('level')->default(0);
			$table->boolean('status')->default(1);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('packages');
	}

}
