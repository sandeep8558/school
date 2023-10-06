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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('address');
            $table->string('city', 100);
            $table->string('pincode', 8);
            $table->string('state', 50);
            $table->string('country', 50);
            $table->double('lng');
            $table->double('lat');
            $table->string('email', 100);
            $table->string('phone', 12);
            $table->set('curriculum', ['SSC', 'CBSE', 'ICSE', 'IGCSE', 'IB', 'NIOS'])->default('SSC');

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
        Schema::dropIfExists('branches');
    }
};
