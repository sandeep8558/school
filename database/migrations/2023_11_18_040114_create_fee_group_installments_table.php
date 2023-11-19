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
        Schema::create('fee_group_installments', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('fee_group_id')->index();
            $table->integer('ind');
            $table->string('name');
            $table->double('amount');
            $table->date('due_date');
            $table->set('payable_at_admission', ['Yes', 'No']);

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
        Schema::dropIfExists('fee_group_installments');
    }
};
