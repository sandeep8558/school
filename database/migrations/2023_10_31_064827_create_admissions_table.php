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
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('academic_year_id')->index();
            $table->bigInteger('grade_id')->index();
            $table->bigInteger('branch_id')->index();
            $table->bigInteger('house_id')->index()->nullable();
            $table->string('first_name', 65);
            $table->string('middle_name', 65);
            $table->string('last_name', 65);
            $table->string('email', 100);
            $table->string('phone', 12);
            $table->date('doj')->nullable();
            $table->date('doe')->nullable();
            $table->date('dob');
            $table->string('birth_place', 100);
            $table->set('gender', ['Male', 'Female', 'Other']);
            $table->set('blood_group', ['O +ve','O -ve','A +ve','A -ve','B +ve','B -ve','AB +ve','AB -ve','HH','Other',]);
            $table->set('religion', ['Hindu','Muslim','Christian','Sikh','Buddhist','Jain','Atheist','Other']);
            $table->string('cast', 100)->nullable();
            $table->string('subcast', 100)->nullable();
            $table->set('cast_category', ['General Category','Scheduled Castes - SC','Scheduled Tribes - ST','Other Backward Classes - OBC']);
            $table->string('mothertongue', 100);
            $table->string('nationality', 100);
            $table->string('aadhar', 16);
            $table->string('gr_number', 65)->index()->nullable();

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
        Schema::dropIfExists('admissions');
    }
};
