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
            $table->index('question_id');
            $table->index('entry_id');
        });

        Schema::table('entries', function (Blueprint $table) {
            $table->index('survey_id');
        });

        Schema::table('questions', function (Blueprint $table) {
            $table->index('survey_id');
            $table->index('section_id');
        });

        Schema::table('sections', function (Blueprint $table) {
            $table->index('survey_id');
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
            $table->dropIndex('question_id');
            $table->dropIndex('entry_id');
        });

        Schema::table('entries', function (Blueprint $table) {
            $table->dropIndex('survey_id');
        });

        Schema::table('questions', function (Blueprint $table) {
            $table->dropIndex('survey_id');
            $table->dropIndex('section_id');
        });

        Schema::table('sections', function (Blueprint $table) {
            $table->dropIndex('survey_id');
        });
    }
}
