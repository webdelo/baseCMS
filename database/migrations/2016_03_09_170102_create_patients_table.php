<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('patients', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('firstname', 100);
			$table->string('lastname', 100);
			$table->string('patronymic', 100);
			$table->string('address', 500);
			$table->string('workFor', 300);
			$table->string('phone', 50);
			$table->string('email', 50);
			$table->text('note');

			$table->integer('statusId');
			$table->integer('categoryId');
			$table->integer('authorId');
			$table->integer('male');

			$table->timestamp('birthdate');
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
		Schema::drop('patients');
	}

}
