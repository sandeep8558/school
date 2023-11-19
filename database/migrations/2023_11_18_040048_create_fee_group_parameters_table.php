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
        Schema::create('fee_group_parameters', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('fee_group_id')->index();
            $table->string('param');
            $table->double('per_year_fee');
            $table->double('per_month_fee');

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
        Schema::dropIfExists('fee_group_parameters');
    }
};
