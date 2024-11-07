<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorPaymentReceived extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_payment_received', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_number');
            $table->date('payment_date');
            $table->string('bank_name');
            $table->unsignedBigInteger('vendor_id');
            $table->foreign('vendor_id')->references('id')->on('vendor_request_advance')->onDelete('cascade');
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
        Schema::dropIfExists('vendor_payment_received');
    }
}
