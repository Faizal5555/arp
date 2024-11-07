<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationNewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operation_new', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project_no');
            $table->string('purchase_order_no');
            $table->integer('respondent_incentives');
            $table->string('team_leader');
            $table->string('project_manager_name');
            $table->string('quality_analyst_name');
            $table->integer('project_deliverable');
            $table->text('questionnarie');
            $table->text('other_document');
            $table->text('survey_link');
            $table->string('country_name');
            $table->string('sample_target');
            $table->string('sample_achieved');
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
        Schema::dropIfExists('operation_new');
    }
}
