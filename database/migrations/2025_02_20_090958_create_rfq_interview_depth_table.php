<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRfqInterviewDepthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rfq_interview_depth', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rfq_details_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('rfq_details_id')->references('id')->on('rfq_details_tables')->onDelete('cascade')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->longText('interveiw_depth_methodology')->nullable();
            $table->longText('interveiw_depth_currency')->nullable();
            $table->longText('interveiw_depth_loi')->nullable();
            $table->longText('interveiw_depth_client')->nullable();
            $table->longText('interveiw_depth_vendor')->nullable();
            $table->longText('interveiw_depth_no_fgd')->nullable();
            $table->longText('interveiw_depth_sample_fgd')->nullable();
            $table->longText('interveiw_depth_countries')->nullable();
            $table->longText('interveiw_depth_requirements')->nullable();
            $table->longText('interveiw_depth_incentives')->nullable();
            $table->longText('interveiw_depth_moderation')->nullable();
            $table->longText('interveiw_depth_transcripts')->nullable();
            $table->longText('interveiw_depth_project_management')->nullable();
            $table->text('interveiw_depth_other')->nullable();
            $table->text('interveiw_depth_total_cost_1')->nullable();
            $table->text('interveiw_depth_total_cost_2')->nullable();
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
        Schema::dropIfExists('rfq_interview_depth');
    }
}
