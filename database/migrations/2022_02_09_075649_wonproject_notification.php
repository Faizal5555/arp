<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WonprojectNotification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('won_notification', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('won_id');
            $table->string('type');
            $table->string('rfq_no');
            $table->integer('status');
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
        Schema::dropIfExists('won_notification');
    }
}
