<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
//        Schema::create('services', function(Blueprint $table)
//        {
//            $table->increments('id');
//            $table->string('name', 20);
//            $table->string('alias', 20)->unique();
//            $table->text('text');
//            $table->text('description');
//            $table->timestamps();
//        });
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
