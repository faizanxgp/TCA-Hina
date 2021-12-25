<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePartnersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('partners', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('event_id');
			$table->integer('user_id');
			$table->string('type', 10)->default('Partner');
			$table->string('subject', 50)->nullable();
			$table->text('comments', 65535);
			$table->string('started', 3)->nullable()->default('No');
			$table->boolean('status')->nullable()->default(0);
			$table->timestamps();
			$table->unique(['event_id','user_id','type'], 'unique');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('partners');
	}

}
