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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('branch_id')->index();
            $table->string('first_name', 65);
            $table->string('middle_name', 65);
            $table->string('last_name', 65);
            $table->string('email', 100);
            $table->string('phone', 12);
            $table->date('doj')->nullable();
            $table->date('doe')->nullable();
            $table->date('dob');
            $table->set('gender', ['Male', 'Female', 'Other']);
            $table->set('blood_group', ['O +ve','O -ve','A +ve','A -ve','B +ve','B -ve','AB +ve','AB -ve','HH','Other',]);
            $table->string('aadhar', 16);
            $table->string('pan', 16);
            $table->string('employee_code', 65);
            $table->set('religion', ['Hindu','Muslim','Christian','Sikh','Buddhist','Jain','Atheist','Other']);
            $table->string('cast', 100)->nullable();
            $table->string('subcast', 100)->nullable();
            $table->string('mothertongue', 100);
            $table->string('nationality', 100);
            $table->set('marital_status', ['Married', 'Widowed', 'Separated', 'Divorced', 'Single', 'Other']);
            $table->set('qualification', ['Primary School','Secondary School','High School','Undergraduate','Graduate','Diploma','Masters','Doctorate','Other']);
            $table->string('degree', 100);

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
        Schema::dropIfExists('staff');
    }
};
