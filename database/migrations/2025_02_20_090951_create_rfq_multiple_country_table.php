<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRfqMultipleCountryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rfq_multiple_country', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rfq_details_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('rfq_details_id')->references('id')->on('rfq_details_tables')->onDelete('cascade')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('multiple_methodology')->nullable();
            $table->text('multiple_currency')->nullable();
            $table->text('multiple_loi')->nullable();
            $table->text('multiple_client')->nullable();
            $table->text('multiple_vendor')->nullable();
            $table->longText('multiple_countries')->nullable();
            $table->longText('multiple_other')->nullable();
            $table->text('multiple_total_cost')->nullable();
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
        Schema::dropIfExists('rfq_multiple_country');
    }
}
