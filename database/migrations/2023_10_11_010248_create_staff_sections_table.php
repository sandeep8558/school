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
        Schema::create('staff_sections', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('staff_id')->index();
            $table->bigInteger('section_id')->index();
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
        Schema::dropIfExists('staff_sections');
    }
};
