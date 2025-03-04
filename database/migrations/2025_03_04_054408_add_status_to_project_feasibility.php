<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToProjectFeasibility extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_feasibility', function (Blueprint $table) {
            //
            $table->enum('status', ['next', 'closed'])->default('next')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_feasibility', function (Blueprint $table) {
            //
            $table->string('status')->default('next')->change();
        });
    }
}
