<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectFeasibilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_feasibility', function (Blueprint $table) {
            $table->id();
            $table->date('date'); // Date Field
            $table->string('pn_number'); // PN Number
            $table->string('email_subject_line'); // Email Subject Line
            $table->date('project_launch_date'); // Project Launch Date
            $table->json('target_countries')->nullable(); // JSON Field for Target Countries
            $table->json('responded_emails')->nullable(); // JSON Field for Responded Emails
            $table->string('responded_title'); // Responded Title
            $table->string('no_of_sample_required'); // No. of Samples Required
            $table->string('no_of_sample_delivered'); // No. of Samples Delivered
            $table->string('incentive_promised'); // Incentive Promised
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
        Schema::dropIfExists('project_feasibility');
    }
}
