<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePinsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pins', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('event_id');
			$table->text('comments', 65535)->nullable();
			$table->text('community', 65535)->nullable();
			$table->boolean('community_approve')->default(0);
			$table->boolean('planning_activity')->default(0);
			$table->boolean('looking_partner')->default(0);
			$table->integer('user_id');
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
		Schema::drop('pins');
	}

}
