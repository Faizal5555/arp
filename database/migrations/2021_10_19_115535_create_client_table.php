<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('client_country');
            $table->string('client_manager');
            $table->string('client_email');
            $table->string('client_phoneno');
            $table->string('user_id');
            $table->string('client_whatsapp');
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
        Schema::dropIfExists('client');
    }
}
