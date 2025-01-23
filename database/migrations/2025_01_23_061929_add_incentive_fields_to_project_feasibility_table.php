<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIncentiveFieldsToProjectFeasibilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_feasibility', function (Blueprint $table) {
            //
            $table->string('total_incentive_paid')->nullable()->after('incentive_promised'); // Add Total Incentive Paid
            $table->date('incentive_paid_date')->nullable()->after('total_incentive_paid'); // Add Incentive Paid Date
            $table->string('mode_of_payment')->nullable()->after('incentive_paid_date'); // Add Mode of Payment
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_feasibility', function (Blueprint $table) {
            //
            $table->dropColumn('total_incentive_paid'); // Remove Total Incentive Paid
            $table->dropColumn('incentive_paid_date'); // Remove Incentive Paid Date
            $table->dropColumn('mode_of_payment'); // Remove Mode of Payment
        });
    }
}
