<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidRfqTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bid-rfq', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rfq_no');
            $table->string('client_id');
            $table->string('vendor_id');
            $table->string('user_id');
            $table->date('date');
            $table->string('industry');
            $table->date('follow_up_date');
            $table->string('setup_cost');
            $table->string('recruitment');
            $table->string('incentives');
            $table->string('moderation');
            $table->string('transcript');
            $table->string('others');
            $table->string('sample_size');
            $table->string('total_cost');
            $table->string('country');
            $table->text('comments');
            $table->enum('won','lost','next');
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
        Schema::dropIfExists('bid-rfq');
    }
}
