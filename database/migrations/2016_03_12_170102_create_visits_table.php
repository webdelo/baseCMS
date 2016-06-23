<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
//		Schema::create('visits', function(Blueprint $table)
//		{
//			$table->increments('id');
//
//			$table->string('address', 500);
//			$table->string('workFor', 300);
//
//			$table->text('note');
//
//			$table->integer('patientId');
//
//			$table->integer('statusId');
//			$table->integer('categoryId');
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
		Schema::drop('visits');
	}

}
