<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_name');
            $table->string('vendor_country');
            $table->string('vendor_manager');
            $table->string('vendor_email');
            $table->string('vendor_phoneno');
            $table->string('vendor_whatsapp');
            $table->string('user_id');
            $table->unsignedBigInteger('client_id');
            $table->timestamps();
            $table->foreign('client_id')->references('id')->on('client')
                ->onUpdate('cascade')->onDelete('cascade');
            // ALTER TABLE VendorADD FOREIGN KEY (client_id) REFERENCES Client(id);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor');
    }
}
