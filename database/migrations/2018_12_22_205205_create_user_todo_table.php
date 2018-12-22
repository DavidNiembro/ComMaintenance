<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserTodoTable extends Migration {

	public function up()
	{
		Schema::create('user_todo', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('fkTodo')->unsigned();
			$table->integer('fkUser')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('user_todo');
	}
}