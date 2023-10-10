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
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('house_id')->index();
            $table->bigInteger('grade_id')->index();
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
            $table->string('gr_number', 65);

            $table->string('religion', 65);
            $table->string('cast', 65);
            $table->string('mothertongue', 65);
            $table->string('nationality', 65);
            $table->string('family_income_per_year');
            

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
        Schema::dropIfExists('students');
    }
};
