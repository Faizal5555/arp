<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorRequestAdvance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_request_advance', function (Blueprint $table) {
            $table->id();
            $table->string('rfq');
            $table->string('vendor_id');
            $table->integer('amount');
            $table->string('vendor_contract');
            $table->string('invoice_type');
            $table->unsignedBigInteger('operation_id');
            $table->enum('status', ['pending','awaited','paid']);
            $table->timestamps();
            $table->foreign('operation_id')->references('id')->on('operation_new') ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor_request_advance');
    }
}
