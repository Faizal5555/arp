<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientReceivedPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_received_payment', function (Blueprint $table) {
           $table->id();
            $table->string('transaction_number');
            $table->date('date_payment');
            $table->string('bank_name');
            $table->unsignedBigInteger('advance_id');
            $table->timestamps();
            $table->foreign('advance_id')->references('id')->on('client_advance_request');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_received_payment');
    }
}
