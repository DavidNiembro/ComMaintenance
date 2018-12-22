<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTodosTable extends Migration {

	public function up()
	{
		Schema::create('todos', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 255);
			$table->text('description');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('todos');
	}
}