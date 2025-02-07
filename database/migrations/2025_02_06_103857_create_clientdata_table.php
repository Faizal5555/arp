<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientdataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientdata', function (Blueprint $table) {
            $table->id();
            $table->string('sr_no')->nullable();
            $table->string('company_name');
            $table->string('client_firstname');
            $table->string('client_lastname');
            $table->string('title')->nullable();
            $table->string('linkedin_id')->nullable();
            $table->string('client_country');
            $table->string('phone_number')->nullable();
            $table->string('email_address')->unique();
            $table->text('comments')->nullable();
            $table->date('followup_date')->nullable();
            $table->unsignedBigInteger('user_id'); // Authenticated User ID
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('clientdata');
    }
}
