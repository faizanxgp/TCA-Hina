<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('title');
			$table->date('from_date');
			$table->date('upto_date');
			$table->text('description', 16777215)->nullable();
			$table->integer('etype_id')->default(0);
			$table->string('tags')->nullable();
			$table->string('hashtags')->nullable();
			$table->boolean('trending')->default(0);
			$table->text('emoji', 16777215)->nullable();
			$table->text('past_campaigns', 16777215)->nullable();
			$table->text('tips', 16777215)->nullable();
			$table->string('video_url')->nullable();
			$table->string('organizer')->nullable();
			$table->string('organizer_url')->nullable();
			$table->string('organizer_email')->nullable();
			$table->boolean('planning_activity')->default(0);
			$table->boolean('looking_partner')->default(0);
			$table->text('notes', 16777215)->nullable();
			$table->boolean('level')->default(0);
			$table->boolean('status')->default(0);
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
		Schema::drop('events');
	}

}
