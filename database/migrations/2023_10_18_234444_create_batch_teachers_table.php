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
        Schema::create('batch_teachers', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('batch_id')->index();
            $table->bigInteger('subject_in_group_id')->index();
            $table->bigInteger('staff_id')->index();
            $table->set('role', ['Class teacher', 'Co-class teacher', 'Subject teacher']);

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
        Schema::dropIfExists('batch_teachers');
    }
};
