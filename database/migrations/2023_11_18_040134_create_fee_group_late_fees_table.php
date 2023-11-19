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
        Schema::create('fee_group_late_fees', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('fee_group_id')->index();
            $table->double('amount');
            $table->set('per', ['Day', 'Week', 'Month']);

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
        Schema::dropIfExists('fee_group_late_fees');
    }
};
