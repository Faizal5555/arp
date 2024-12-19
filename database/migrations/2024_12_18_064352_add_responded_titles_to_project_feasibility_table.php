<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRespondedTitlesToProjectFeasibilityTable extends Migration
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
            $table->json('responded_titles')->nullable()->after('target_countries');
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
            $table->dropColumn('responded_titles');
        });
    }
}
