<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitsStatusesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
//		Schema::create('visits_statuses', function(Blueprint $table)
//		{
//			$table->increments('id');
//
//			$table->string('name', 100);
//			$table->string('color', 100);
//			$table->string('alias', 100);
//
//			$table->text('description');
//
//			$table->integer('authorId');
//			$table->timestamps();
//
//		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('visits_statuses');
	}

}
