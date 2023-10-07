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
        Schema::create('staff_addresses', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('staff_id')->index();
            $table->string('address');
            $table->string('city', 65);
            $table->string('pincode', 12);
            $table->string('state', 65);
            $table->string('country', 65);

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
        Schema::dropIfExists('staff_addresses');
    }
};
