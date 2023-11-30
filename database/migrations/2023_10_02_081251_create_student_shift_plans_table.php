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
        Schema::create('student_shift_plans', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('student_shift_id')->index();
            $table->integer('period_index');
            $table->time('from');
            $table->time('to');
            $table->set('slot', ['Lecture', 'Short Break', 'Long Break', 'Interaction', 'Prayer', 'Assembly']);
            $table->set('is_in_halfday', ['Yes', 'No']);

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
        Schema::dropIfExists('student_shift_plans');
    }
};
