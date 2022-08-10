<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKeysIndexToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('answers', function (Blueprint $table) {
            $table->foreign('question_id')->on('questions')->references('id');
            $table->foreign('entry_id')->on('entries')->references('id');
        });

        Schema::table('entries', function (Blueprint $table) {
            $table->foreign('survey_id')->on('surveys')->references('id');
        });

        Schema::table('questions', function (Blueprint $table) {
            $table->foreign('survey_id')->on('surveys')->references('id');
            $table->foreign('section_id')->on('sections')->references('id');
        });

        Schema::table('sections', function (Blueprint $table) {
            $table->foreign('survey_id')->on('surveys')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('answers', function (Blueprint $table) {

        });
    }
}
