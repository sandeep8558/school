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

            $table->bigInteger('student_id')->index()->nullable();

            $table->bigInteger('first_language_id')->index();
            $table->bigInteger('second_language_id')->index();
            $table->bigInteger('third_language_id')->index();

            $table->string('previous_school')->nullable();
            $table->set('board', ['SSC', 'CBSE', 'ICSE', 'IGCSE', 'IB', 'NIOS'])->nullable();

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

            $table->set('is_single_parent', ['Yes', 'No']);
            $table->set('single_what', ['Mother', 'Father'])->nullable();
            $table->set('is_alumnus', ['Yes', 'No']);
            $table->set('special_need', ['Yes', 'No', 'Not Sure']);
            $table->set('speaking_hearing', ['Yes', 'No']);

            $table->integer('rating_1')->default(0);
            $table->integer('rating_2')->default(0);
            $table->integer('rating_3')->default(0);
            $table->integer('rating_4')->default(0);
            $table->integer('rating_5')->default(0);
            $table->integer('rating_6')->default(0);
            $table->integer('rating_7')->default(0);
            $table->integer('rating_8')->default(0);
            $table->integer('rating_9')->default(0);
            $table->integer('rating_10')->default(0);
            $table->integer('rating_11')->default(0);
            $table->integer('rating_12')->default(0);
            $table->integer('total_rating')->default(0);
            $table->set('status', ['Accepted', 'Rejected', 'Hold', 'Cancelled', 'Confirmed', 'Pending'])->default('Pending');

            $table->timestamp('payment_at')->nullable();

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
