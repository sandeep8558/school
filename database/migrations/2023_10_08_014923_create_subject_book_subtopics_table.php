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
        Schema::create('subject_book_subtopics', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('subject_book_topic_id')->index();
            $table->integer('subtopic_index');
            $table->string('subtopic');

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
        Schema::dropIfExists('subject_book_subtopics');
    }
};
