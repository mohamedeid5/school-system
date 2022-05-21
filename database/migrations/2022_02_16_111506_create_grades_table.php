<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration {

	public function up()
	{
		Schema::create('grades', function(Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->longText('notes')->nullable();
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('grades');
	}
}
