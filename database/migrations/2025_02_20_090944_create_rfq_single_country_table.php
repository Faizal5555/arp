<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRfqSingleCountryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rfq_single_country', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rfq_details_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('rfq_details_id')->references('id')->on('rfq_details_tables')->onDelete('cascade')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('single_methodology')->nullable();
            $table->text('single_currency')->nullable();
            $table->text('single_loi')->nullable();
            $table->text('single_country')->nullable();
            $table->text('single_client')->nullable();
            $table->text('single_vendor')->nullable();
            $table->text('single_sample')->nullable();
            $table->text('single_fieldwork')->nullable();
            $table->text('single_other')->nullable();
            $table->text('single_total_cost')->nullable();
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
        Schema::dropIfExists('rfq_single_country');
    }
}
