<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTargetFieldsToBusinessResearchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_research', function (Blueprint $table) {
            //
            $table->string('target_respondent')->nullable()->after('others');
            $table->text('target_countries')->nullable()->after('target_respondent'); // If you plan to store multiple countries as comma-separated or JSON
            $table->date('end_date')->nullable()->after('target_countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_research', function (Blueprint $table) {
            //
            $table->dropColumn(['target_respondent', 'target_countries', 'end_date']);
        });
    }
}
