<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('from_grade');
            $table->unsignedBigInteger('from_classroom');
            $table->unsignedBigInteger('from_section');
            $table->unsignedBigInteger('to_grade');
            $table->unsignedBigInteger('to_classroom');
            $table->unsignedBigInteger('to_section');
            $table->string('academic_year');
            $table->string('academic_year_new');
            $table->timestamps();
        });

        // relations
        Schema::table('promotions', function (Blueprint $table) {
            $table->foreign('student_id')->on('students')->references('id')->cascadeOnDelete();
            $table->foreign('from_grade')->on('grades')->references('id')->cascadeOnDelete();
            $table->foreign('from_classroom')->on('classrooms')->references('id')->cascadeOnDelete();
            $table->foreign('from_section')->on('sections')->references('id')->cascadeOnDelete();
            $table->foreign('to_grade')->on('grades')->references('id')->cascadeOnDelete();
            $table->foreign('to_classroom')->on('classrooms')->references('id')->cascadeOnDelete();
            $table->foreign('to_section')->on('sections')->references('id')->cascadeOnDelete();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotions');
    }
}
