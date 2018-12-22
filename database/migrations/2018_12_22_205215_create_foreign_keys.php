<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('checklist_items', function(Blueprint $table) {
			$table->foreign('fkTodo')->references('id')->on('todos')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('user_todo', function(Blueprint $table) {
			$table->foreign('fkTodo')->references('id')->on('todos')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('user_todo', function(Blueprint $table) {
			$table->foreign('fkUser')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('checklist_items', function(Blueprint $table) {
			$table->dropForeign('checklist_items_fkTodo_foreign');
		});
		Schema::table('user_todo', function(Blueprint $table) {
			$table->dropForeign('user_todo_fkTodo_foreign');
		});
		Schema::table('user_todo', function(Blueprint $table) {
			$table->dropForeign('user_todo_fkUser_foreign');
		});
	}
}