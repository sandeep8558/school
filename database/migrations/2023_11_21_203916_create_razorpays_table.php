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
        Schema::create('razorpays', function (Blueprint $table) {
            $table->id();

            $table->string('user_id');

            $table->string('razorpay_payment_id');
            $table->string('razorpay_order_id');
            $table->string('razorpay_signature');
            $table->integer('verified');

            $table->bigInteger('razorpayable_id')->index();
            $table->string('razorpayable_type');

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
        Schema::dropIfExists('razorpays');
    }
};
