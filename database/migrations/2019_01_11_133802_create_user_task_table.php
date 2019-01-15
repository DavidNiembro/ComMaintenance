<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserTaskTable extends Migration {

	public function up()
	{
		Schema::create('user_task', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('fkTask')->unsigned();
			$table->integer('fkUser')->unsigned();
			$table->datetime('beginTask');
			$table->datetime('endTask');
			$table->boolean('state');
		});
	}

	public function down()
	{
		Schema::drop('user_task');
	}
}