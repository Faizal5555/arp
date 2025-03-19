<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessResearchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_research', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('pn_number');
            $table->string('subject_line');
            $table->string('client_name');
            $table->string('industry');
            $table->text('others')->nullable();
            $table->text('attachments')->nullable();
            $table->unsignedBigInteger('user_id'); // Creator or owner
            $table->enum('status', ['next', 'closed'])->default('next');
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
        Schema::dropIfExists('business_research');
    }
}
