<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('tasks', function(Blueprint $table) {
			$table->foreign('fkTodo')->references('id')->on('todos')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('user_task', function(Blueprint $table) {
			$table->foreign('fkTask')->references('id')->on('tasks')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('user_task', function(Blueprint $table) {
			$table->foreign('fkUser')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('role_user', function(Blueprint $table) {
			$table->foreign('role_id')->references('id')->on('roles')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('role_user', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('tasks', function(Blueprint $table) {
			$table->dropForeign('tasks_fkTodo_foreign');
		});
		Schema::table('user_task', function(Blueprint $table) {
			$table->dropForeign('user_task_fkTask_foreign');
		});
		Schema::table('user_task', function(Blueprint $table) {
			$table->dropForeign('user_task_fkUser_foreign');
		});
		Schema::table('role_user', function(Blueprint $table) {
			$table->dropForeign('role_user_fkRole_foreign');
		});
		Schema::table('role_user', function(Blueprint $table) {
			$table->dropForeign('role_user_fkUser_foreign');
		});
	}
}