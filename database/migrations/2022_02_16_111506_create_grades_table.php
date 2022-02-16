<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration {

	public function up()
	{
		Schema::create('grades', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 30);
			$table->longText('notes');
		});
	}

	public function down()
	{
		Schema::drop('grades');
	}
}
