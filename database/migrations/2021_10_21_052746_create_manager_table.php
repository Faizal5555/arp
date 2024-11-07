<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManagerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manager', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('address');
            $table->integer('phone_no');
            $table->integer('whatsapp_no');
            $table->text('photo');
            $table->text('other_document');
            $table->string('experiance');
            $table->string('others');
            $table->string('country');
            $table->string('qualification');
            $table->string('email');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manager');
    }
}
