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
        Schema::create('admission_parents', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('admission_id')->index();
            $table->set('relation', ['Father', 'Mother', 'Other']);
            $table->string('first_name', 65);
            $table->string('middle_name', 65);
            $table->string('last_name', 65);
            $table->string('email', 100);
            $table->string('phone', 12);
            $table->date('dob');
            $table->string('pan', 16);
            $table->string('aadhar', 16);
            $table->set('qualification', ['Primary School','Secondary School','High School','Undergraduate','Graduate','Diploma','Masters','Doctorate','Other']);
            $table->string('degree', 100);
            $table->string('occupation', 100);
            $table->set('annual_income', ['below 1 Lac', '1 Lac to 5 Lac', '5 Lac to 10 Lac', '10 Lac and above']);
            $table->string('company_name', 100);
            $table->string('company_address');
            
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
        Schema::dropIfExists('admission_parents');
    }
};
