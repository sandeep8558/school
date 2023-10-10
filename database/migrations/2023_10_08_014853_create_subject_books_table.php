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
        Schema::create('subject_books', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('subject_in_group_id')->index();
            $table->string('book_title');
            $table->string('publication');
            $table->set('status', ['Active', 'Absolute']);

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
        Schema::dropIfExists('subject_books');
    }
};
