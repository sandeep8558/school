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
        Schema::create('grade_subjects', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('grade_id')->index();
            $table->bigInteger('subject_id')->index();
            $table->integer('lectures_per_week');
            $table->set('is_consecutive', ['Yes', 'No', 'Any']);
            $table->set('is_graded', ['Yes', 'No']);

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
        Schema::dropIfExists('grade_subjects');
    }
};
