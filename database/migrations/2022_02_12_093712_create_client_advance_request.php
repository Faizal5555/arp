<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientAdvanceRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_advance_request', function (Blueprint $table) {
            $table->id();
            $table->string('rfq');
            $table->string('client_id');
            $table->integer('amount');
            $table->string('client_contract');
            $table->string('invoice_type');
            $table->unsignedBigInteger('operation_id');
            $table->enum('status', ['pending','awaited','paid']);
            $table->timestamps();
            $table->foreign('operation_id')->references('id')->on('operation_new');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_advance_request');
    }
}
