<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatacenternewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datacenternews', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('cityname');
            $table->string('citycode');
            $table->integer('PhNumber');
            $table->string('email');;
            $table->integer('whatdsappNumber');
            $table->string('docterSpeciality');
            $table->string('totalExperience');
            $table->string('practice');
            $table->string('licence');
            $table->string('PatientsMonth');
            $table->string('country1');
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
        Schema::dropIfExists('datacenternews');
    }
}