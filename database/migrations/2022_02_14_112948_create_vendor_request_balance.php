<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorRequestBalance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_request_balance', function (Blueprint $table) {
            $table->id();
            $table->string('rfq');
            $table->string('vendor_id');
            $table->integer('vendor_balance');
            $table->string('vendor_contract');
            $table->unsignedBigInteger('operation_id');
            $table->enum('status', ['invoice', 'awaited']);
            $table->timestamps();
            $table->foreign('operation_id')->references('id')->on('operation_new')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor_request_balance');
    }
}
