<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timetable_data', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('batch_id')->index();
            $table->bigInteger('timetable_id')->index();
            $table->bigInteger('batch_teacher_id')->index()->nullable();
            $table->bigInteger('student_shift_plan_id')->index();
            $table->set('day', ['Mon','Tue','Wed','Thu','Fri','Sat','Sun']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timetable_data');
    }
};
