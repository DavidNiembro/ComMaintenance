<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTasksTable extends Migration {

	public function up()
	{
		Schema::create('tasks', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 255);
			$table->text('description')->nullable();
			$table->boolean('state');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('fkTodo')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('tasks');
	}
}