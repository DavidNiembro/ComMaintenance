<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChecklistItemsTable extends Migration {

	public function up()
	{
		Schema::create('checklist_items', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 255);
			$table->text('description');
			$table->boolean('state');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('fkTodo')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('checklist_items');
	}
}