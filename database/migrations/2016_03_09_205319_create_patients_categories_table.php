<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('patients_categories', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('name', 400);
            $table->string('alias')->unique();
            $table->integer('parentId');
            $table->text('description');
            $table->integer('statusId');
            $table->integer('authorId');
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
        Schema::drop('patients_categories');
	}

}
