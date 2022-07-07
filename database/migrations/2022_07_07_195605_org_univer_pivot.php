<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrgUniverPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('org_univer_pivot', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(\App\Models\OrgCategory::class)->index();
            $table->foreignIdFor(\App\Models\UniverCategory::class)->index();

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
        //
    }
}
