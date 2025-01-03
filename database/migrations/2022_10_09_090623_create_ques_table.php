<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ques', function (Blueprint $table) {
            $table->id();
            $table->string('country');
            $table->boolean('agree_all')->default(0);
            $table->boolean('privacy_policy_condition')->default(0);
            $table->boolean('market_research')->default(0);
            $table->boolean('market_research_purpose')->default(0);
            $table->boolean('mobile_advertising')->default(0);
            $table->boolean('third_party_cookie')->default(0);
            $table->boolean('sensitive_data')->default(0);
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('que_1')->nullable();
            $table->string('que_2')->nullable();
            $table->string('que_3')->nullable();
            $table->string('que_4')->nullable();
            $table->string('que_5')->nullable();
            $table->string('que_6')->nullable();
            $table->string('que_7')->nullable();
            $table->string('que_8')->nullable();
            $table->string('que_9')->nullable();
            $table->string('que_10')->nullable();
            $table->string('que_11')->nullable();
            $table->string('que_12')->nullable();
            $table->string('que_13')->nullable();
            $table->string('que_14')->nullable();
            $table->string('que_15')->nullable();
            $table->string('que_16')->nullable();
            $table->string('que_17')->nullable();
            $table->string('que_18')->nullable();
            $table->string('que_19')->nullable();
            $table->string('que_20')->nullable();
            $table->string('que_21')->nullable();
            $table->string('que_22')->nullable();
            $table->string('que_23')->nullable();
            $table->string('que_24')->nullable();
            $table->string('que_25')->nullable();
            $table->string('que_26')->nullable();
            $table->string('que_27')->nullable();
            $table->string('que_28')->nullable();
            $table->string('que_29')->nullable();
            $table->string('que_30')->nullable();
            $table->string('que_31')->nullable();
            $table->string('que_32')->nullable();
            $table->string('que_33')->nullable();
            $table->string('que_34')->nullable();
            $table->string('que_35')->nullable();
            $table->string('que_36')->nullable();
            $table->string('que_37')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();      
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
        Schema::dropIfExists('ques');
    }
}
