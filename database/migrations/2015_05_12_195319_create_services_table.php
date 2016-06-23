<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('services', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('name', 400);
            $table->text('description');

            $table->float('price');
            $table->integer('measure');
            $table->integer('measurementId');

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
        Schema::drop('services');
	}

}
