<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncentivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incentives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('datacenter_id')->nullable();
            $table->unsignedBigInteger('que_id')->nullable();
            $table->string('pn_number');
            $table->string('incentive_promised');
            $table->string('total_incentive_paid');
            $table->text('incentive_paid_date');
            $table->string('mode_of_payment');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('datacenter_id')->references('id')->on('datacenternews')->onDelete('cascade');
            //$table->foreign('que_id')->references('id')->on('ques')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incentives');
    }
}
