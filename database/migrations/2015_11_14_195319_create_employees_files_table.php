<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesFilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('employees_files', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title', 1000);
            $table->text('description');
            $table->string('filename', 1000);
            $table->string('mime', 1000);
            $table->integer('objectId');
            $table->integer('statusId');
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
        Schema::drop('employees_files');
	}

}
