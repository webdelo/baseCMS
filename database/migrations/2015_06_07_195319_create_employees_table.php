<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('employees', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('firstname', 100);
            $table->string('lastname', 100);
            $table->string('patronymic', 100);
            $table->timestamp('birthdate');
            $table->integer('positionId');

            $table->text('description');
            $table->integer('statusId');
            $table->integer('male');
            $table->integer('categoryId');
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
        Schema::drop('employees');
	}

}
