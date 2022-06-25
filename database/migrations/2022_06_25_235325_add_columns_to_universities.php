<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUniversities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('universities', function (Blueprint $table) {
            $table->string('slug')->nullable();
            $table->boolean('enabled')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('universities', function (Blueprint $table) {
            $table->dropColumn('slug');
            $table->dropColumn('enabled');
        });
    }
}
