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
        Schema::create('student_branches', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('student_id')->index();
            $table->bigInteger('branch_id')->index();
            $table->date('from')->nullable();
            $table->date('to')->nullable();

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
        Schema::dropIfExists('student_branches');
    }
};
