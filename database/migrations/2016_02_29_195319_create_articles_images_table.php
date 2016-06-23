<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('articles_images', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title', 250);
            $table->text('description');
            $table->string('filename', 350);
            $table->string('mime', 30);
            $table->string('ext', 5);
            $table->string('size', 300);
            $table->integer('objectId');
            $table->integer('statusId');
            $table->integer('categoryId');
            $table->integer('priority');
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
        Schema::drop('articles_images');
	}

}
