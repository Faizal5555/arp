<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRfqOnlineCommunityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rfq_online_community', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rfq_details_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('rfq_details_id')->references('id')->on('rfq_details_tables')->onDelete('cascade')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->longText('online_community_methodology')->nullable();
            $table->longText('online_community_currency')->nullable();
            $table->longText('online_community_duration')->nullable();
            $table->longText('online_community_client')->nullable();
            $table->longText('online_community_vendor')->nullable();
            $table->longText('online_community_loi_screener')->nullable();
            $table->longText('online_community_sample_loi_month')->nullable();
            $table->longText('online_community_countries')->nullable();
            $table->longText('online_community_requirements')->nullable();
            $table->longText('online_community_incentives')->nullable();
            $table->longText('online_community_moderation')->nullable();
            $table->longText('online_community_pmfree')->nullable();
            $table->longText('online_community_other')->nullable();
            $table->text('online_community_total_cost')->nullable();
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
        Schema::dropIfExists('rfq_online_community');
    }
}
