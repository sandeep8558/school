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
        Schema::create('academic_years', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('branch_id')->index();
            $table->string('name');
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->set('is_admission_closed', ['Yes','No']);
            $table->set('is_academic_year_closed', ['Yes','No']);

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
        Schema::dropIfExists('academic_years');
    }
};
